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

    public function index(Request $request)
    {
        $data = DB::table('peternak')->get();
        // dd($data);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
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
            // 'phone' => 'required|string|max:15',
            'jenis' => 'required|string|max:255',
        ]);
        $prefix = 'PTK';
        $year = Carbon::now()->format('y');
        $padLength = 4;
        $newRowData = [
            'nama' => $request->name,
            'jenis_ternak' => $request->jenis,
            'alamat' => $request->address,
            'kelurahan'=> $request->kelurahan,
            'kecamatan'=> $request->kecamatan,
            'no_hp' => $request->phone,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $count = DB::table('peternak')->count();
        if($count == 0){
            $newRowData['id_peternak'] = "{$prefix}{$year}001";
        }else{
            $lastRow = DB::table('peternak')->orderBy('id_peternak', 'desc')->first();
            $lastId = $lastRow->id_peternak;
            if(substr($lastId, 3, 2 ) != $year){
                $id = ['id_peternak'=>"{$prefix}{$year}001"];
                
            }else{
                $number = sprintf("%03d",substr($lastId, 5) + 1) ;
                $id = ['id_peternak'=>"{$prefix}{$year}{$number}"];
            }
            $newRowData = array_merge($id,$newRowData);
            // $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            // $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            // $newRowData['id_peternak'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        
        // dd($newRowData);
        DB::table('peternak')->insert($newRowData);
     
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'peternak',
            'primary_key' => $newRowData['id_peternak'],
            'row'         => $newRowData
        ]);
        // Insert the new row into the database
        if($request->username && $request->password){
            $account = array(
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role'  => 'peternak',
                // 'email' => $newRowData['email'],
                'id_user' => $newRowData['id_peternak']);
            $usr_id = DB::table('users')->insertGetId($account);
            
        }
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'users',
            'primary_key' => $usr_id,
            'row'         => array_merge(['id'=>$usr_id],$account)
        ]);
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
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };
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
                ->select('peternak.*', 'users.username', 'users.password')
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
            'jenis_ternak' => $request->jenis,
            'alamat' => $request->address,
            'kelurahan'=> $request->kelurahan,
            'kecamatan'=> $request->kecamatan,
            'no_hp' => $request->phone,
            'updated_at' => Carbon::now(),
        ];
        DB::table('peternak')->where('id_peternak', $id)->update($newRowData);
        // Update the user account if provided\
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'peternak',
            'primary_key' => 'id_peternak',
            'row'         => array_merge(['id_peternak' => $id], $newRowData),
        ]);
        DB::table('users')->where('id_user', $id)->update([
            'username' => $request->username,
            // 'email' => $request->email,
            ]);        
        $usr_id = DB::table('users')->where('id_user', $id)->first()->id_user;
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'users',
            'primary_key' => $usr_id,
            'row'         => array_merge(['id'=>$usr_id,'username'=>$request->username],)
        ]);
         if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect()->route('peternak.index')->with('success', 'Data Peternak Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        //
        DB::table('peternak')->where('id_peternak', $id)->delete();
        DB::table('users')->where('id_user', $id)->delete();
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'peternak',
            'primary_key' => 'id_peternak',
            'row'         => ['id_peternak' => $id],
        ]);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'users',
            'primary_key' => 'id_user',
            'row'         => ['id_user' => $id],
        ]);
         if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect()->route('peternak.index')->with('success', 'Data Peternak Berhasil Dihapus');
    }
}
