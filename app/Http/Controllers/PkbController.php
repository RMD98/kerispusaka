<?php

namespace App\Http\Controllers;

use App\Services\GDriveExcelService ;
use Illuminate\Http\Request;
use DB;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use Date;

class PkbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $gdrive;
    
    public function __construct(GDriveExcelService $gdrive){
        $this->gdrive = $gdrive;
    }
   

    public function index(Request $request)
    {
        $data = DB::table('pkb')->paginate(10);
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return view('pkb.pkb',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pkb.add_pkb');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $newRowData = [
            'id_kejadian' => $request->kejadian,
            'id_ib' => $request->ib,
            'no_dokumen' => $request->dokumen,
            'id_staff' => $request->staff,
            'id_ticket' => $request->ticket,
            'hasil' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'ib' => 'required|string|max:255',
            'dokumen' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
    
    
        $prefix = 'PKB';
        $year = Carbon::now()->format('Y');
        $padLength = 4;
        $count = DB::table('pkb')->count();
        if($count == 0){
            $newRowData['id_pkb'] = "{$prefix}-{$year}-0001";
        }else{
            $lastRow = DB::table('pkb')->orderBy('id_pkb', 'desc')->first();
            $lastId = $lastRow->id_pkb;
            $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData['id_pkb'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        $statusIB;
        $count = DB::table('ib')->where('id_kejadian',$newRowData['id_kejadian'])->count();
        if (strtolower($newRowData['hasil']) === 'sukses') {
            $newRowData['hasil'] = 'Berhasil';
            $statusIB = 'IB Berhasil';
        } elseif (strtolower($newRowData['hasil']) === 'gagal') {
            $newRowData['hasil'] = 'Gagal';
            $statusIB = 'IB Gagal';
            if($count == 3){
                $hasil = 'Gagal';
            }
        } 
        DB::table('pkb')->insert($newRowData);

        $statusToSet = $newRowData['hasil'];
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'pkb',
            'primary_key' => $newRowData['id_pkb'],
            'row'         => $newRowData
        ]);
        if($statusToSet != 'Belum Ada Tindakan'){
            DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => 'IB ke -'.$count.' '.$statusToSet,
                'hasil' => $hasil ?? '',
                'updated_at' => Carbon::now(),
            ]);
            DB::table('ib')->where('id_ib', $newRowData['id_ib'])->update([
                'hasil' => $statusIB,
                'updated_at' => Carbon::now(),
            ]);
        }
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'kejadian',
            'primary_key' => 'id_kejadian',
            'row'         => [
                'id_kejadian'=>$newRowData['id_kejadian'], 
                'status' => $statusToSet,
                'hasil' => $hasil ?? '',
                'updated_at' => Carbon::now(),]
        ]);

        // return redirect('/pkb');
        return redirect('/kejadian/show/'.$newRowData['id_kejadian'])->with('success', 'Data PKB berhasil ditambahkan.');
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $id = $request->kejadian;
        $data = DB::table('pkb')
            ->Where('id_kejadian','like', "{$id}%")
            ->where(function($query) use ($search) {
                $query->where('id_pkb', 'like', "%{$search}%")
                      ->orWhere('id_ib', 'like', "%{$search}%")
                      ->orWhere('no_dokumen', 'like', "%{$search}%")
                      ->orWhere('id_staff', 'like', "%{$search}%");
            })
            ->select('*',DB::RAW("CONCAT(id_pkb) AS text"))
            ->get();
      
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $data = DB::table('pkb')->where('id_pkb', $id)
                ->join('kejadian','kejadian.id_kejadian','pkb.id_kejadian')
                ->join('peternak','kejadian.id_peternak','peternak.id_peternak')
                ->select('pkb.*', 'peternak.nama as nama')
                ->first();

        return view('pkb.edit_pkb', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $newRowData = [
            'id_kejadian' => $request->kejadian,
            'id_ib' => $request->ib,
            'no_dokumen' => $request->dokumen,
            'id_staff' => $request->staff,
            'hasil' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'ib' => 'required|string|max:255',
            'dokumen' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
        $statusIB;
        $count = DB::table('ib')->where('id_kejadian',$newRowData['id_kejadian'])->count();

        if (strtolower($newRowData['hasil']) === 'sukses') {
            $newRowData['hasil'] = 'Berhasil';
            $statusIB = 'IB Berhasil';
        } elseif (strtolower($newRowData['hasil']) === 'gagal') {
            $newRowData['hasil'] = 'Gagal';
            $statusIB = 'IB Gagal';
             if($count == 3){
                $hasil = 'Gagal';
            }
            
        }
        $statusToSet = $newRowData['hasil'];
        DB::table('pkb')->where('id_pkb', $id)
            ->update($newRowData);
            
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'pkb',
            'primary_key' => 'id_pkb',
            'row'         => array_merge(['id_pkb'=>$id],$newRowData),
        ]);
        if($statusToSet){
            DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'hasil' => $hasil ?? 'Belum Ada Hasil',
                'updated_at' => new \DateTime()
            ]);
            DB::table('ib')->where('id_ib', $newRowData['id_ib'])
            ->update([
                'status' => $statusIB,
                'updated_at' => new \DateTime()
            ]);
            fire_and_forget(env('SHEET_WEBHOOK_URL'), [
                'action'      => 'update',
                'table'       => 'kejadian',
                'primary_key' => 'id_kejadian',
                'row'         => [
                    'id_kejadian'=>$newRowData['id_kejadian'],
                    'status' => $statusToSet,
                    'hasil' => $hasil ?? 'Belum Ada Hasil',
                    'updated_at' => new \DateTime()]
            ]);
        }
        return redirect('/pkb');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        DB::table('pkb')->where('id_pkb', $id)->delete();
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'pkb',
            'primary_key' => 'id_pkb',
            'row'         => ['id_pkb' => $id]
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect('/pkb');
    }
}
