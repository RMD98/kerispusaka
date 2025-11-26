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
        //     'sheet' => $content->getSheetByName('ib'),
        //     'localPath' => $file['path'],
        //     'file' => $file['file'],
        // ];
    }

    public function index()
    {
        //
        $data = DB::table('ib')->get();
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
        $newRowData = [
            'id_kejadian' => $request->kejadian,
            'id_staff' => $request->staff,
            'pejantan' => $request->pejantan,
            'no_dokumen' => $request->dokumen,
            'hasil' => $request->status,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'pejantan' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
        // dd($newRowData);
        // $file = $this->gdrive->findFileByNameInFolder();

        // $sheetData = $this->read($file);
        // $spreadsheet = $sheetData['spreadsheet'];
        // $sheet = $sheetData['sheet'];
        // $localPath = $sheetData['localPath'];
        // $file = $sheetData['file'];

        // // Get the existing data and headers
        // $rows = $sheet->toArray();
        // $headers = array_map('strtolower', $rows[0]); // Convert headers to lowercase for consistency

    
        $prefix = 'IB';
        $year = Carbon::now()->format('Y');
        $padLength = 4;
        $count = DB::table('ib')->count();
        if($count == 0){
            $newRowData['id_ib'] = "{$prefix}-{$year}-0001";
        }else{
            $lastRow = DB::table('ib')->orderBy('id_ib', 'desc')->first();
            $lastId = $lastRow->id_ib;
            $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData['id_ib'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        DB::table('ib')->insert($newRowData);
       
        $statusToSet = $request->status;
        if (strtolower($newRowData['hasil']) === 'sukses') {
            $statusToSet = 'Inseminasi Buatan Berhasil';
        } elseif (strtolower($newRowData['hasil']) === 'gagal') {
            $statusToSet = 'Inseminasi Buatan Gagal';
        }
        DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
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
        $data = DB::table('ib')->where('id_ib', $id)->first();

        return view('ib.edit_ib', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        // foreach ($rows as $i => $row) {
        //     if ($i === 0) continue;
        //     if ($row[$idColIndex] == $id) {
        //         foreach ($headers as $j => $header) {
        //             $sheet->setCellValueByColumnAndRow($j + 1, $i + 1, $newData[$header] ?? $row[$j]);
        //         }
        //         break;
        //     }
        // }
        // // Update the status in the 'kejadian' sheet
        // $newSheet = $spreadsheet->getSheetByName('kejadian');
        // $kejadian = $newSheet->toArray();
        // $targetHeaders = array_map('strtolower', $kejadian[0]); // convert to lowercase for consistency
        // $idIndex = array_search('id_kejadian', $targetHeaders);
        // $statusIndex = array_search('status', $targetHeaders); // Column to update
        // $tanggalIndex = array_search('tanggal_diperbarui', $targetHeaders); // Column to update
        $newData = [
            'id_kejadian' => $request->kejadian,
            'id_staff' => $request->staff,
            'hasil' => $request->status,
            'created_at' => $request->tanggal,
        ];
        
        $statusToSet = $request->status;
        if (strtolower($newData['hasil']) === 'sukses') {
            $statusToSet = 'Inseminasi Buatan Berhasil';
        } elseif (strtolower($newData['hasil']) === 'gagal') {
            $statusToSet = 'Inseminasi Buatan Gagal';}
        DB::table('ib')->where('id_ib', $id)
            ->update([
                'id_kejadian' => $newData['id_kejadian'],
                'id_staff' => $newData['id_staff'],
                'hasil' => $statusToSet,
                'created_at' => $newData['created_at'],
                'updated_at' => new \DateTime()
            ]);
        if($statusToSet){

            DB::table('kejadian')->where('id_kejadian', $newData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
            ]);
        }
        // Only apply if statusToSet is defined
        // if ($statusToSet && $idIndex !== false && $statusIndex !== false) {
        //     foreach ($kejadian as $rowIndex => $row) {
        //         if ($rowIndex === 0) continue; // skip header
        //         if (isset($row[$idIndex]) && $row[$idIndex] === $newData['id_kejadian']) {
        //             $newSheet->setCellValueByColumnAndRow($statusIndex + 1, $rowIndex + 1, $statusToSet);
        //             $newSheet->setCellValueByColumnAndRow($tanggalIndex + 1, $rowIndex + 1, new \Date);

        //             break;
        //         }
        //     }
         
        // }
        
        // // Save the updated spreadsheet
        // $writer = new Xlsx($spreadsheet);
        // $writer->save($localPath);
        // $this->gdrive->uploadOrUpdateFile($localPath, $file->name);

        return redirect('/ib');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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

        // foreach ($rows as $i => $row) {
        //     if ($i === 0) continue;
        //     if ($row[$idColIndex] == $id) {
        //         $sheet->removeRow($i + 1);
        //         break;
        //     }
        // }

        // $writer = new Xlsx($spreadsheet);
        // $writer->save($localPath);
        // $this->gdrive->uploadOrUpdateFile($localPath, $file->name);
        DB::table('ib')->where('id_ib', $id)->delete();
        return redirect('/ib');
    }
}
