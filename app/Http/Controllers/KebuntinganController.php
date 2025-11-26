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

class KebuntinganController extends Controller
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
        //     'sheet' => $content->getSheetByName('kebuntingan'),
        //     'localPath' => $file['path'],
        //     'file' => $file['file'],
        // ];
    }

    public function index()
    {
        //
        $data = DB::table('kebuntingan')->get();
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
        return view('kebuntingan.kebuntingan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kebuntingan.add_kebuntingan');
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
            'status' => $request->status,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
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

    
        $prefix = 'KEBUNTINGAN';
        $year = Carbon::now()->format('Y');
        $padLength = 4;
        $count = DB::table('kebuntingan')->count();
        if($count == 0){
            $newRowData['id_kebuntingan'] = "{$prefix}-{$year}-0001";
        }else{
            $lastRow = DB::table('kebuntingan')->orderBy('id_kebuntingan', 'desc')->first();
            $lastId = $lastRow->id_kebuntingan;
            $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData['id_kebuntingan'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        DB::table('kebuntingan')->insert($newRowData);
        //  Find max numeric part from existing IDs
        // $maxNumber = 0;
        // if (in_array('id', $headers)) {
        //     $idColIndex = array_search('id', $headers);
        //     foreach ($rows as $i => $row) {
        //         if ($i === 0) continue;
        //         $id = $row[$idColIndex] ?? '';
        //         if (preg_match('/' . $prefix . '-' . $year . '-(\d+)/', $id, $matches)) {
        //             $num = (int) $matches[1];
        //             if ($num > $maxNumber) {
        //                 $maxNumber = $num;
        //             }
        //         }
        //     }

        //     // Generate next custom ID
        //     $nextNumber = str_pad($maxNumber + 1, $padLength, '0', STR_PAD_LEFT);
        //     $customId = "{$prefix}-{$year}-{$nextNumber}";
        //     $newRowData['id'] = $customId;
        // }

        // // Map the new row data to match the spreadsheet headers
        // $newRow = [];
        // foreach ($headers as $header) {
        //     $newRow[] = $newRowData[$header] ?? ''; // Use blank if the header is not in the request
        // }

        // // Append the new row to the next available row
        
        // $lastRow = count($rows) + 1;;
        // // foreach ($rows as $i => $row) {
        // //     if ($i === 0) continue; // Skip header row
        // //     if (array_filter($row)) {
        // //         $lastRow = $i + 2;
        // //     }
        // // }
        // foreach ($newRow as $columnIndex => $value) {
        //     $sheet->setCellValueByColumnAndRow($columnIndex + 1, $lastRow, $value);
        // }
        
        // // Update the status in the 'kejadian' sheet
        // $newSheet = $spreadsheet->getSheetByName('kejadian');
        // $kejadian = $newSheet->toArray();
        // $targetHeaders = array_map('strtolower', $kejadian[0]); // convert to lowercase for consistency
        // $idIndex = array_search('id_kejadian', $targetHeaders);
        // $statusIndex = array_search('status', $targetHeaders); // Column to update
        // $statusToSet = null;
        if (strtolower($newRowData['status']) === 'sukses') {
            $statusToSet = 'Kelahiran Berhasil';
        } elseif (strtolower($newRowData['status']) === 'gagal') {
            $statusToSet = 'Kelahiran Gagal';
        }
        DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'updated_at' => new \DateTime()
            ]);
    
        // Only apply if statusToSet is defined
        // if ($statusToSet && $idIndex !== false && $statusIndex !== false) {
        //     foreach ($kejadian as $rowIndex => $row) {
        //         if ($rowIndex === 0) continue; // skip header
        //         if (isset($row[$idIndex]) && $row[$idIndex] === $newRowData['id_kejadian']) {
        //             $newSheet->setCellValueByColumnAndRow($statusIndex + 1, $rowIndex + 1, $statusToSet);
        //             break;
        //         }
        //     }
        //     // dd(isset($row[$idIndex]), $row[$idIndex], $newRowData['id']);
        // }
        // // dd($newSheet);
        // // Step 7: Save and upload back
        // $writer = new Xlsx($spreadsheet);
        // $writer->save($localPath);

        // $this->gdrive->uploadOrUpdateFile($localPath, $file->name);


        return redirect('/kebuntingan');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $data = DB::table('kebuntingan')
            ->where('id_kebuntingan', 'like', "%{$search}%")
            ->orWhere('id_kejadian', 'like', "%{$search}%")
            ->orWhere('id_staff', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%")
            ->orWhere('tanggal', 'like', "%{$search}%")
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
        $data = DB::table('kebuntingan')->where('id_kebuntingan', $id)->first();
        // Uncomment the following lines if you want to read from a Google Drive file
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

        return view('kebuntingan.edit_kebuntingan', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $newData = [
            'id_kejadian' => $request->kejadian,
            'id_staff' => $request->staff,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
        ];

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
        // $statusToSet = null;
        if (strtolower($newData['status']) === 'sukses') {
            $statusToSet = 'Inseminasi Buatan Berhasil';
        } elseif (strtolower($newData['status']) === 'gagal') {
            $statusToSet = 'Inseminasi Buatan Gagal';
        } else{
            $statusToSet = $newData['status'];
        }
        DB::table('kebuntingan')->where('id_kebuntingan', $id)
            ->update([
                'id_kejadian' => $newData['id_kejadian'],
                'id_staff' => $newData['id_staff'],
                'status' => $statusToSet,
                'tanggal' => $newData['tanggal'],
            ]);
        DB::table('kejadian')->where('id_kejadian', $newData['id_kejadian'])
            ->update([
                'status' => $statusToSet,
                'tanggal_diperbarui' => new \DateTime()
            ]);
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

        return redirect('/kebuntingan');
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
        DB::table('kebuntingan')->where('id_kebuntingan', $id)->delete();
        return redirect('/kebuntingan');
    }
}
