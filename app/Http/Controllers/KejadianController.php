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

class KejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $gdrive;
    
    public function __construct(GDriveExcelService $gdrive){
        $this->gdrive = $gdrive;
    }
    public function read($file){
        // $filename = 'Date.xlsx';
        
        // if(empty($result)){
        //     return response()->json(['error' =>'File Not Found']);
        // }

        // $file = $result[0];
        // $localPath = storage_path("app/temp/{$file->name}");

        // if(!file_exists(dirname($localPath))){
        //     mkdir(dirname($localPath), 0755, true);
        // }

        // $this->gdrive->downloadExcelFile($file->id,$localPath);
        // dd($file['path']);
        // $content = Excel::toArray([],$file['path']);
        // $content = IOFactory::load($file['path']);
        // $sheet = $content->getSheetByName('staff');
        // $data = $sheet->toArray();
        // return response()->json([
            //     'file' => $file['file']->name,
            //     'content' => $data,
            //     'sheet' => $sheet,
            // ]);
        // $content = IOFactory::load($file['path']);
        // return[
        //     'spreadsheet' => $content,
        //     'sheet' => $content->getSheetByName('kejadian'),
        //     'localPath' => $file['path'],
        //     'file' => $file['file'],
        // ];
    }

    public function index(Request $request)
    {
        //
        if(auth()->user()->role == 'peternak'){
            $data = DB::table('kejadian')
                    ->join('betina','kejadian.id_betina','betina.id_betina')
                    ->join('peternak','betina.id_peternak','peternak.id_peternak')
                    ->where('peternak.id_peternak','=',auth()->user()->id_user)
                    ->select('kejadian.*')
                    ->paginate(10);
        }elseif(auth()->user()->role == 'super admin'){
            $data = DB::table('kejadian')->paginate(10);
        }
       
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return view('kejadian.kejadian',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kejadian.add_kejadian');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $newRowData = [
            'id_peternak' => $request->peternak,
            'id_betina' => $request->betina,
            'created_at' => $request->tanggal,
            'status' => $request->status,
        ];
        // $request->validate([
        //     'jantan' => 'required|string|max:255',
        //     'betina' => 'required|email|max:255',
        //     'tanggal' => 'required|string|max:255',
        //     'status' => 'required|string|max:15',
        // ]);
        $prefix = 'Kejadian';
        $year = Carbon::now()->format('y.m');
        $padLength = 4;

        $count = DB::table('kejadian')->count();
        if($count == 0){
            $newRowData['id_kejadian'] = "{$prefix}-{$year}.001";
        }else{
            $lastRow = DB::table('kejadian')->orderBy('id_kejadian', 'desc')->first();
            $lastId = $lastRow->id_kejadian;
            if(substr($lastId,strrpos($lastId,'-')+1,5)!=$year){
                $id = ['id_kejadian' => "{$prefix}-{$year}.001"];
            } else{
                $number = sprintf("%03d",substr($lastId, strrpos($lastId,'-')+5)+1);
                $id = ['id_kejadian' => "{$prefix}-{$year}.{$number}"];
            }
            $newRowData = array_merge($id,$newRowData);
        };
        DB::table('kejadian')->insert($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'kejadian',
            'primary_key' => $newRowData['id_kejadian'],
            'row'         => $newRowData,
        ]);
        if ($request->expectsJson()) {

                return response()->json([
                    'status' => 'success',
                    'data' => $newRowData
                ]);
            };
        

        return redirect('/kejadian')->with('success', 'Data Kejadian Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $data = DB::table('kejadian')
            ->where('id_peternak', 'like', "%{$search}%")
            ->orWhere('id_betina', 'like', "%{$search}%")
            ->orWhere('created_at', 'like', "%{$search}%")
            ->orWhere('updated_at', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%")
            ->get();
        // Uncomment the following lines if you want to read from a Google Drive file
        // $file = $this->gdrive->findFileByNameInFolder();
      
        // $excel = $this->read($file);
        // $rows = $excel['sheet']->toArray();
        // $headers = array_map('strtolower', $rows[0]); // convert to lowercase for consistency

        // $data = [];

        // foreach (array_slice($rows, 1) as $row) {
        //     if (stripos(implode(' ', $row), $search) !== false) {
        //         $data[] = array_combine($headers, $row);
        //     }
        // }

        return response()->json($data);
    }
    public function show(string $id)
    {
        //
        $data = DB::table('kejadian')->where('id_kejadian', $id)->first();
        $peternak = DB::table('peternak')->where('id_peternak', $data->id_peternak)->first();
        $betina = DB::table('betina')->where('ear_tag', $data->id_betina)->first();
        // dd($data);
        $ib = DB::table('ib')->where('id_kejadian', $id)->get();
        $pkb = DB::table('pkb')->where('id_kejadian', $id)->get();

        $kelahiran = DB::table('kelahiran')->where('id_kejadian', $id)->get();
        
        return view('kejadian.show_kejadian', compact('data','ib','pkb','peternak','betina','kelahiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = DB::table('kejadian')->where('id_kejadian', $id)
                ->join('betina','kejadian.id_betina','ear_tag')->first();
        return view('kejadian.edit_kejadian', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $newRowData = [
            'id_peternak' => $request->peternak,
            'id_betina' => $request->betina,
            'id_ticket' => $request->ticket,
            'created_at' => $request->tanggal,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ];
        DB::table('kejadian')->where('id_kejadian', $id)->update($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'kejadian',
            'primary_key' => 'id_kejadian',
            'row'         => array_merge(['id_kejadian' => $id], $newRowData)
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };
        return redirect('/kejadian')->with('success', 'Data Kejadian Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        //
        DB::table('kejadian')->where('id_kejadian', $id)->delete();
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'kejadian',
            'primary_key' => 'id_kejadian',
            'row'  => ['id_kejadian' => $id],
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $id
            ]);
        };
        return redirect('/kejadian')->with('success', 'Data Kejadian Berhasil Dihapus');
    }
}
