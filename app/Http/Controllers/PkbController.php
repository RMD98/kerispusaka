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
   

    public function index()
    {
        $data = DB::table('pkb')->get();
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
        DB::table('pkb')->insert($newRowData);
       
        $statusToSet = null;
        if (strtolower($newRowData['hasil']) === 'sukses') {
            $statusToSet = 'PKB Berhasil';
        } elseif (strtolower($newRowData['hasil']) === 'gagal') {
            $statusToSet = 'PKB Gagal';
        }
        if($statusToSet){
            DB::table('ib')->where('id_ib',$newRowData['id_ib'])->update(['hasil'=>$statusToSet]);
            DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => Carbon::now(),
            ]);
        }

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
        
        $data = DB::table('pkb')->where('id_pkb', $id)->first();

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
        
        $statusToSet = null;
        if (strtolower($newRowData['hasil']) === 'sukses') {
            $statusToSet = 'Inseminasi Buatan Berhasil';
        } elseif (strtolower($newRowData['hasil']) === 'gagal') {
            $statusToSet = 'Inseminasi Buatan Gagal';}
        DB::table('pkb')->where('id_pkb', $id)
            ->update($newRowData);
        if($statusToSet){
            DB::table('ib')->where('id_ib',$newRowData['id_ib'])->update(['hasil'=>$statusToSet]);
            DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
            ]);
        }
        return redirect('/pkb');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pkb')->where('id_pkb', $id)->delete();
        return redirect('/pkb');
    }
}
