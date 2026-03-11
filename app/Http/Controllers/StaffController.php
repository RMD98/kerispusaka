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
use Hash;


class StaffController extends Controller
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
            'sheet' => $content->getSheetByName('staff'),
            'localPath' => $file['path'],
            'file' => $file['file'],
        ];
    }

    public function index(Request $request)
    {
        //
        $data = DB::table('staff')->paginate(10);
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

        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
    
        return view('staff.staff',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('staff.add_staff');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $newRowData = [
            'nama' => $request->name,
            // 'email' => $request->email,
            'asal' => $request->asal,
            'surat_izin' => $request->izin,
            // 'jabatan' => $request->jabatan,
            'no_hp' => $request->phone,
        ];
        
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'izin'=> 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $prefix = 'STAFF';
        $year = Carbon::now()->format('y');
        
        $count = DB::table('staff')->count();
        if($count == 0){
            $newRowData['id_staff'] = "{$prefix}-{$year}001";
        }else{
            $lastRow = DB::table('staff')->orderBy('id_staff', 'desc')->first();
            $lastId = $lastRow->id_staff;
            $lastNumber = substr($lastId, strrpos($lastId, '-') + 1,2);
            if($lastNumber != $year){
                $id = ['id_staff'=>"{$prefix}-{$year}001"];
            }else{
                $number = sprintf("%03d", substr($lastId, strrpos($lastId, '-') + 3)+1);
                $id = ['id_staff'=>"{$prefix}-{$year}{$number}"];
            }
            // $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData = array_merge($id,$newRowData);
            // dd($newRowData);
        };

        DB::table('staff')->insert($newRowData);        
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'staff',
            'primary_key' => $newRowData['id_staff'],
            'row'         => $newRowData
        ]);
        $account =[];
        if($request->username && $request->password){
            $account = array(
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role'  => $request->jabatan,
                // 'email' => $newRowData['email'],
                'id_user' => $newRowData['id_staff'],
            );
            $usr_id =DB::table('users')->insertGetId($account);
        }
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'users',
            'primary_key' => $usr_id,
            'row'         => array_merge(['id'=>$usr_id],$account)
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
    
        return redirect('/staff');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
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
        $data = DB::table('staff')->where('nama', 'like', "%{$search}%")
            // ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('surat_izin', 'like', "%{$search}%")
            ->orWhere('asal', 'like', "%{$search}%")
            ->orWhere('no_hp', 'like', "%{$search}%")
            ->select('id_staff',DB::raw("CONCAT(id_staff,'-',nama)as text"))
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
        $data = DB::table('staff')->where('id_staff', $id)
                ->join('users','id_user','id_staff')->first();
        
        return view('staff.edit_staff', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $newRowData = [
            'nama' => $request->name,
            // 'email' => $request->email,
            'surat_izin' => $request->izin,
            'asal' => $request->asal,
            // 'jabatan' => $request->jabatan,
            'no_hp' => $request->phone,
        ];
        
        $request->validate([
            'name' => 'required|string|max:255',
            'izin' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'asal' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
        DB::table('staff')->where('id_staff',$id)->update($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'staff',
            'primary_key' => 'id_staff',
            'row'         => $newRowData
        ]);
        DB::table('users')->where('id_user',$id)->update([
            'username' => $request->username,
            // 'password' => Hash::make($request->password),
            'role'  => $request->jabatan,
            // 'email' => $newRowData['email'],
        ]);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'users',
            'primary_key' => $usr_id,
            'row'         => array_merge(['id'=>$usr_id,'username'=>$request->username],)
        ]);
        // DB::table('log')->insert([
        //     'user_name' => Auth()->user()->user_name,
        //     'ip_address' => request()->ip(),
        //     'jenis_log' => 'Update',
        //     'keterangan' => "Staff {$newRowData['nama']} dengan ID {$id} telah diupdate oleh ".Auth()->user()->user_name,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect()->route('staff.index')->with('success', 'Data Staff Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        //
        DB::table('staff')->where('id_staff', $id)->delete();
        DB::table('users')->where('id_user', $id)->delete();
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'staff',
            'primary_key' => 'id_staff',
            'row'         => ['id_staff' => $id],
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
        return redirect()->route('staff.index')->with('success', 'Data Staff Berhasil Dihapus');
    }
}
