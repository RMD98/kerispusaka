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

class PejantanController extends Controller
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
        $content = IOFactory::load($file['path']);
        return[
            'spreadsheet' => $content,
            'sheet' => $content->getSheetByName('pejantan'),
            'localPath' => $file['path'],
            'file' => $file['file'],
        ];
    }

    public function index()
    {
       
        $data = DB::table('pejantan')->get();
        // dd($data);
        
        return view('pejantan.pejantan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pejantan.add_pejantan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $newRowData = [
            'id_pejantan' => $request->pejantan,
            'id_pembuatan' => $request->pembuatan,
            'jenis_straw' => $request->jenis,
            'asal_straw' => $request->asal,
            'persentase' => $request->persentase,
            'created_at' => Carbon::now(),
        ];
        
        $request->validate([
            'pejantan' => 'required|string|max:255|unique:pejantan,id_pejantan',
            'pembuatan' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
        ]);
        
        // $prefix = 'JANTAN';
        // $year = Carbon::now()->format('Y');
        // $padLength = 4;
        // $count = DB::table('pejantan')->count();
        // if($count == 0){
        //     $newRowData['id_pejantan'] = "{$prefix}-{$year}-0001";
        // }else{
        //     $lastRow = DB::table('pejantan')->orderBy('id_pejantan', 'desc')->first();
        //     $lastId = $lastRow->id_pejantan;
        //     $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
        //     $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        //     $newRowData['id_pejantan'] = "{$prefix}-{$year}-{$nextNumber}";
        // };
        DB::table('pejantan')->insert($newRowData);
       

        return redirect('/pejantan')->with('success', 'Data Pejantan Berhasil Ditambahkan');
    }

    public function search (Request $request)
    {
    
        $search = $request->input('search');
    
        $data = DB::table('pejantan')
            ->where('id_pejantan', 'like', "%{$search}%")
            ->orWhere('id_pembuatan','like',"%{$search}%")
            ->orWhere('jenis_straw','like',"%{$search}%")
            ->orWhere('asal_straw','like',"%{$search}%")
            ->select('pejantan.*',DB::RAW("CONCAT(id_pejantan,'-',jenis_straw,'-',asal_straw) as text"))
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
        //
        $data = DB::table('pejantan')->where('id_pejantan', $id)->first();
        return view('pejantan.edit_pejantan', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $newRowData = [
            'id_pejantan' => $request->pejantan,
            'id_pembuatan' => $request->pembuatan,
            'jenis_straw' => $request->jenis,
            'asal_straw' => $request->asal,
            'persentase' => $request->persentase,
            'created_at' => Carbon::now(),
        ];
        
        // dd($request->all(),);
        $request->validate([
            'pejantan' => 'required|string|max:255|unique:pejantan,id_pejantan,'.$id.',id_pejantan',
            'pembuatan' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
        ]);
        
        DB::table('pejantan')->where('id_pejantan',$id)->update($newRowData);
       

        return redirect('/pejantan')->with('success', 'Data Pejantan Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('pejantan')->where('id_pejantan', $id)->delete();
        return redirect()->route('pejantan.index')->with('success', 'Data Pejantan Berhasil Dihapus');
    }
}
