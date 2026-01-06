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

    public function index()
    {
        //
        if(auth()->user()->role == 'peternak'){
            $data = DB::table('kejadian')
                    ->join('betina','kejadian.id_betina','betina.id_betina')
                    ->join('peternak','betina.id_peternak','peternak.id_peternak')
                    ->where('peternak.id_peternak','=',auth()->user()->id_user)
                    ->select('kejadian.*')
                    ->get();
        }elseif(auth()->user()->role == 'super admin'){
            $data = DB::table('kejadian')->get();
        }
        // if(!file_exists(dirname($file['path']))){
            // mkdir(dirname($file['path']), 0755, true);
            // }
        // $file = $this->gdrive->findFileByNameInFolder();
        // $this->gdrive->downloadExcelFile($file['file']->id,$file['path']);
        // $excel = $this->read($file);
        // $rows = $excel['sheet']->toArray();
        // $headers = array_map('strtolower', $rows[0]); // convert to lowercase for consistency

        // $data = [];

        // foreach (array_slice($rows, 1) as $row) {
        //     $data[] = array_combine($headers, $row);
        // }
        // dd($data);
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
        $prefix = 'KEJADIAN';
        $year = Carbon::now()->format('Y');
        $padLength = 4;

        $count = DB::table('kejadian')->count();
        if($count == 0){
            $newRowData['id_kejadian'] = "{$prefix}-{$year}-0001";
        }else{
            $lastRow = DB::table('kejadian')->orderBy('id_kejadian', 'desc')->first();
            $lastId = $lastRow->id_kejadian;
            $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData['id_kejadian'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        DB::table('kejadian')->insert($newRowData);
    
        

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
            'created_at' => $request->tanggal,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ];
        DB::table('kejadian')->where('id_kejadian', $id)->update($newRowData);
        return redirect('/kejadian')->with('success', 'Data Kejadian Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('kejadian')->where('id_kejadian', $id)->delete();
        return redirect('/kejadian')->with('success', 'Data Kejadian Berhasil Dihapus');
    }
}
