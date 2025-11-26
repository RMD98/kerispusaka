<?php

namespace App\Http\Controllers;

use App\Services\GDriveExcelService ;
use Illuminate\Http\Request;
use DB;
use Hash;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
class PeternakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $gdrive;
    
    public function __construct(GDriveExcelService $gdrive){
        $this->gdrive = $gdrive;
    }
    public function read($file){
        $content = IOFactory::load($file['path']);
        return[
            'spreadsheet' => $content,
            'sheet' => $content->getSheetByName('peternak'),
            'localPath' => $file['path'],
            'file' => $file['file'],
        ];
    }

    public function index()
    {
        //
        // $file = $this->gdrive->findFileByNameInFolder();
        // $this->gdrive->downloadExcelFile($file['file']->id,$file['path']);
        // $excel = $this->read($file);
        // $rows = $excel['sheet']->toArray();
        // // dd($rows);
        // $headers = array_map('strtolower', $rows[0]); // convert to lowercase for consistency

        // $data = [];

        // foreach (array_slice($rows, 1) as $row) {
        //     $data[] = array_combine($headers, $row);
        // }
        $data = DB::table('peternak')->get();
        // dd($data);
        return view('peternak.peternak',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('peternak.add_peternak');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
        $prefix = 'PETERNAK';
        $year = Carbon::now()->format('Y');
        $padLength = 4;
        $newRowData = [
            'nama' => $request->name,
            // 'email' => $request->email,
            'alamat' => $request->address,
            'no_hp' => $request->phone,
        ];
        $count = DB::table('peternak')->count();
        if($count == 0){
            $newRowData['id_peternak'] = "{$prefix}-{$year}-0001";
        }else{
            $lastRow = DB::table('peternak')->orderBy('id_peternak', 'desc')->first();
            $lastId = $lastRow->id_peternak;
            $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData['id_peternak'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        DB::table('peternak')->insert($newRowData);
        // Insert the new row into the database
        if($request->username && $request->password){
            $account = array(
                'user_name' => $request->username,
                'password' => Hash::make($request->password),
                'role'  => 'peternak',
                // 'email' => $newRowData['email'],
                'id_user' => $newRowData['id_peternak']);
            DB::table('users')->insert($account);
            
        }
        // $file = $this->gdrive->findFileByNameInFolder();

        // $sheetData = $this->read($file);
        // $spreadsheet = $sheetData['spreadsheet'];
        // $sheet = $sheetData['sheet'];
        // $localPath = $sheetData['localPath'];
        // $file = $sheetData['file'];

        // // Get the existing data and headers
        // $rows = $sheet->toArray();
        // $headers = array_map('strtolower', $rows[0]); // Convert headers to lowercase for consistency

    
        
       
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
        
        //  $lastRow = count($rows) + 1;;
        // // foreach ($rows as $i => $row) {
        // //     if ($i === 0) continue; // Skip header row
        // //     if (array_filter($row)) {
        // //         $lastRow = $i + 2;
        // //     }
        // // }
        // foreach ($newRow as $columnIndex => $value) {
        //     $sheet->setCellValueByColumnAndRow($columnIndex + 1, $lastRow, $value);
        // }
        // // dd($columnIndex);

        // // Step 7: Save and upload back
        // $writer = new Xlsx($spreadsheet);
        // $writer->save($localPath);

        // $this->gdrive->uploadOrUpdateFile($localPath, $file->name);

        return redirect()->route('peternak.index')->with('success', 'Data Peternak Berhasil Ditambahkan');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        // $file = $this->gdrive->findFileByNameInFolder();
        
        // $excel = $this->read($file);
        // $rows = $excel['sheet']->toArray();
        // $headers = array_map('strtolower', $rows[0]); // convert to lowercase for consistency
        // $data = [];
        
        // foreach (array_slice($rows, 1) as $row) {
        //     if (stripos($row[1],$search) !== false) {
        //         $data[] = array_combine($headers, $row);
        //     }
        // };
        $data = DB::table('peternak')->where('nama', 'like', "%{$search}%")
        ->orWhere('alamat', 'like', "%{$search}%")
        ->orWhere('no_hp', 'like', "%{$search}%")
        ->select('id_peternak',DB::raw("CONCAT(id_peternak,'-',nama)as text"))
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
        $data = DB::table('peternak')->join('users', 'peternak.id_peternak', 'users.id_user')
                ->where('id_peternak', $id)
                ->select('peternak.*', 'users.user_name', 'users.password')
                ->first();
        return view('peternak.edit_peternak', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $newRowData = [
            'nama' => $request->name,
            // 'email' => $request->email,
            'alamat' => $request->address,
            'no_hp' => $request->phone,
        ];
        DB::table('peternak')->where('id_peternak', $id)->update($newRowData);
        // Update the user account if provided\
        DB::table('users')->where('id_user', $id)->update([
            'user_name' => $request->username,
            // 'email' => $request->email,
        ]);        

        return redirect()->route('peternak.index')->with('success', 'Data Peternak Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('peternak')->where('id_peternak', $id)->delete();
        DB::table('users')->where('id_user', $id)->delete();
        return redirect()->route('peternak.index')->with('success', 'Data Peternak Berhasil Dihapus');
    }
}
