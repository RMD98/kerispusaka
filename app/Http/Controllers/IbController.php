<?php

namespace App\Http\Controllers;

use App\Services\GDriveExcelService ;
use Illuminate\Http\Request;
use DB;
// //use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use Date;
class IbController extends Controller
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
        //
        $data = DB::table('ib')->paginate(10);
     
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return view('ib.ib',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ib.add_ib');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
     
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'pejantan' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);

        $year = Carbon::now()->format('y.m');
        $count = DB::table('ib')->count();
        if($count == 0){
           $id = '001';
        }else{
            $lastRow = DB::table('ib')->orderBy('id_ib', 'desc')->first();
            $lastId = $lastRow->id_ib;
            // dd(substr($lastId, strrpos($lastId,'-') +1,5));
            if(substr($lastId, strrpos($lastId,'-') +1,5) != $year){
                $id = '001';
            } else{
                
                $number = explode('-', $lastId)[1];
                $id = explode('.',$number)[2] + 1;
                // $id = ['id_ib' => "{$prefix}-{$year}.{$number}"];
            }
            
        };
           $newRowData = [
            'id_ib' => "IB-{$year}.".sprintf('%03d', $id),
            'id_kejadian' => $request->kejadian,
            'id_staff' => $request->staff,
            'id_ticket' => $request->ticket,
            'pejantan' => $request->pejantan,
            'no_dokumen' => $request->dokumen,
            'hasil' => $request->status,
            'created_at' => $request->tanggal,
        ];
         if (strtolower($newRowData['hasil']) === 'sukses') {
            $newRowData['hasil'] = 'Inseminasi Buatan Berhasil';
        } elseif (strtolower($newRowData['hasil']) === 'gagal') {
            $newRowData['hasil'] = 'Inseminasi Buatan Gagal';}
        $statusToSet = $newRowData['hasil'];

        DB::table('ib')->insert($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'ib',
            'primary_key' => $newRowData['id_ib'],
            'row'         => $newRowData
        ]);
       
        DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
            ]);
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };
       
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
        'action'      => 'update',
        'table'       => 'kejadian',
        'primary_key' => 'id_kejadian',
        'row'         => [
            'id_kejadian' => $newRowData['id_kejadian'], 
            'status' => $statusToSet,
            'updated_at' => new \DateTime()
            ],
        ]);
     
        return redirect()->to('/kejadian/show/'.$newRowData['id_kejadian']);
    }

    public function search(Request $request)
    {
        $search = $request->get('q');
        $id = $request->get('kejadian');
        $data = DB::table('ib')
            ->Where('id_kejadian', 'like', "%{$id}%")
            ->where('id_ib', 'like', "%{$search}%")
            ->select('id_ib',DB::raw("CONCAT(id_ib,',',id_kejadian,',',id_staff)as text"))
            ->get();
        // Uncomment the following lines if you want to read from a Google Drive file
        // $file = $this->gdrive->findFileByNameInFolder();
        // $excel = $this->read($file);
        // $rows = $excel['sheet']->toArray();
        // $headers = array_map('strtolower', $rows[0]); // convert to lowercase for consistency

        // $data = [];

        // foreach (array_slice($rows, 1) as $row) {
        //     if (stripos($row[0],$search) !== false) {
        //         $data[] = array_combine($headers, $row);
        //     }
        // }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function statistics(){
        $data = DB::table('ib')
                ->selectRaw('hasil, Count(*) as total')
                ->groupBy('hasil')
                ->pluck('total','hasil');
        return response()->json([
            'labels' => $data->keys(),
            'data' => $data->values(),
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // $file = $this->gdrive->findFileByNameInFolder();
        // $sheetData = $this->read($file);
        // $spreadsheet = $sheetData['spreadsheet'];
        // $sheet = $sheetData['sheet'];
        // $localPath = $sheetData['localPath'];
        // $file = $sheetData['file'];

        // $rows = $sheet->toArray();
        // $headers = array_map('strtolower', $rows[0]);
        // $idColIndex = array_search('id', $headers);
        // $data = [];
        // foreach ($rows as $i => $row) {
        //     if ($i === 0) continue;
        //     if ($row[$idColIndex] == $id) {
        //         $data = array_combine($headers, $row);
        //         break;
        //     }
        // }
        $data = DB::table('ib')->where('id_ib', $id)
                ->join('kejadian','kejadian.id_kejadian','ib.id_kejadian')
                ->join('peternak','kejadian.id_peternak','peternak.id_peternak')
                ->select('ib.*','peternak.nama')
                ->first();

        return view('ib.edit_ib', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $newData = [
            'id_kejadian' => $request->kejadian,
            'id_staff' => $request->staff,
            'id_ticket' => $request->ticket,
            'hasil' => $request->status,
            'created_at' => $request->tanggal,
            'updated_at' => new \DateTime()
        ];
        
        if (strtolower($newData['hasil']) === 'sukses') {
            $newData['hasil'] = 'Inseminasi Buatan Berhasil';
        } elseif (strtolower($newData['hasil']) === 'gagal') {
            $newData['hasil'] = 'Inseminasi Buatan Gagal';}
        $statusToSet = $newData['hasil'];
        DB::table('ib')->where('id_ib', $id)
            ->update($newData);
         fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'ib',
            'primary_key' => 'id_ib',
            'row'         => array_merge(['id_ib'=>$id],$newData),
        ]);
        
        if($statusToSet){
            DB::table('kejadian')->where('id_kejadian', $newData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
            ]);
        }
        
          fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'kejadian',
            'primary_key' => 'id_kejadian',
            'row'         => [
                'id_kejadian' => $newData['id_kejadian'],
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
            ],
        ]);

          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };
        return redirect('/ib');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        DB::table('ib')->where('id_ib', $id)->delete();
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'ib',
            'primary_key' => 'id_ib',
            'row'         => ['id_ib' => $id],
        ]);
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect('/ib');
    }
}
