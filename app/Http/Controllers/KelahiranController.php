<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
Use DB;
class KelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = DB::table('kelahiran')->paginate(10);
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return view('kelahiran.kelahiran',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kelahiran.add_kelahiran');
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
            'nama' => $request->nama,
            'id_ticket' => $request->ticket,
            'jenis_kelamin' => $request->kelamin,
            // 'keunggulan' => $request->keunggulan,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|string|max:255',
            // 'keunggulan' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
            
        $prefix = 'KELAHIRAN';
        $year = Carbon::now()->format('y.m');
        $padLength = 4;
        $count = DB::table('kelahiran')->count();
        if($count == 0){
            $newRowData['id_kelahiran'] = "{$prefix}-{$year}.001";
        }else{
            $lastRow = DB::table('kelahiran')->orderBy('id_kelahiran', 'desc')->first();
            $lastId = $lastRow->id_kelahiran;
            if(substr($lastId,strrpos($lastId,'-')+1,5)!=$year){
                $newRowData['id_kelahiran'] = "{$prefix}-{$year}.001";
            } else{
                $number = sprintf("%03d",substr($lastId, strrpos($lastId,'-')+5)+1);
                $newRowData['id_kelahiran'] = "{$prefix}-{$year}.{$number}";
            }
            
            };
        // $newRowData = array_merge($id,$newRowData);
        DB::table('kelahiran')->insert($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'kelahiran',
            'primary_key' => $newRowData['id_kelahiran'],
            'row'         => $newRowData
        ]);
        $status;
        // if($newRowData['id_pkb'] != null){
        $jmlIb= DB::table('ib')->where('id_kejadian', $newRowData['id_kejadian'])->count();
        if($jmlIb != 0){
            $status = 'Kelahiran Pada IB ke-'.$jmlIb;
            $hasil = 'Berhasil';
        } else{
            $status = 'Kelahiran Alami';
        }
        // dd($status);
        DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $status,
                'hasil' => $hasil ?? 'Belum Ada Hasil',
                'updated_at' => new \DateTime()
            ]);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'kejadian',
            'primary_key' => 'id_kejadian',
            'row'         => [
                'id_kejadinan' =>$newRowData['id_kejadian'], 
                'status' => $status,
                'hasil' => $hasil ?? 'Belum Ada Hasil',
                'updated_at' => new \DateTime()]
        ]);
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };

        return redirect('/kelahiran');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $data = DB::table('kelahiran')
            ->where('id_kebuntingan', 'like', "%{$search}%")
            ->orWhere('id_kejadian', 'like', "%{$search}%")
            ->orWhere('id_staff', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%")
            ->orWhere('tanggal', 'like', "%{$search}%")
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
        $data = DB::table('kelahiran')->where('id_kelahiran', $id)
                // ->join('kejadian','kejadian.id_kejadian','kelahiran.id_kejadian')
                // ->join('peternak','kejadian.id_peternak','peternak.id_peternak')
                ->first();

        return view('kelahiran.edit_kelahiran', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $newRowData = [
            'id_kejadian' => $request->kejadian,
            'id_staff' => $request->staff,
            'nama' => $request->nama,
            'id_ticket' =>$request->ticket,
            'jenis_kelamin' => $request->kelamin,
            // 'keunggulan' => $request->keunggulan,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|string|max:255',
            // 'keunggulan' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
        DB::table('kelahiran')->where('id_kelahiran', $id)
            ->update($newRowData);
        // DB::table('kejadian')->where('id_kejadian', $newData['id_kejadian'])
        //     ->update([
        //         'status' => $statusToSet,
        //         'tanggal_diperbarui' => new \DateTime()
        //     ]);
     
        // return redirect('/kelahiran');
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'kelahiran',
            'primary_key' => 'id_kelahiran',
            'row'         => array_merge(['id_kelahiran'=>$id],$newRowData)
        ]);
          if ($request->expectsJson()) {

                return response()->json([
                    'status' => 'success',
                    'data' => $newRowData
                ]);
            };
        return redirect('/kejadian/show/'.$newRowData['id_kejadian']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
       
        DB::table('kelahiran')->where('id_kelahiran', $id)->delete();
          if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $id
            ]);
        };
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'kelahiran',
            'primary_key' => 'id_kelahiran',
            'row'         => ['id_kelahiran' => $id]
        ]);
        return redirect('/kelahiran');
    }
}
