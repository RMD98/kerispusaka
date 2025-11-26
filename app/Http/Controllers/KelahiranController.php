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
    public function index()
    {
        //
        $data = DB::table('kelahiran')->get();
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
            'jenis_kelamin' => $request->kelamin,
            'keunggulan' => $request->keunggulan,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|string|max:255',
            'keunggulan' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
        

    
        $prefix = 'KELAHIRAN';
        $year = Carbon::now()->format('Y');
        $padLength = 4;
        $count = DB::table('kelahiran')->count();
        if($count == 0){
            $newRowData['id_kelahiran'] = "{$prefix}-{$year}-0001";
        }else{
            $lastRow = DB::table('kelahiran')->orderBy('id_kelahiran', 'desc')->first();
            $lastId = $lastRow->id_kelahiran;
            $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newRowData['id_kelahiran'] = "{$prefix}-{$year}-{$nextNumber}";
        };
        DB::table('kelahiran')->insert($newRowData);
        $status;
        // if($newRowData['id_pkb'] != null){
        $jmlIb= DB::table('ib')->where('id_kejadian', $newRowData['id_kejadian'])->count();
        if($jmlIb != 0){
            $status = 'Kelaiharn Pada IB ke-'.$jmlIb;
        } else{
            $status = 'Kelahiran Alami';
        }
        // dd($status);
        DB::table('kejadian')->where('id_kejadian', $newRowData['id_kejadian'])
            ->update([
                'status' => $status,
                'updated_at' => new \DateTime()
            ]);
    
     

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
        $data = DB::table('kelahiran')->where('id_kelahiran', $id)->first();

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
            'jenis_kelamin' => $request->kelamin,
            'keunggulan' => $request->keunggulan,
            'created_at' => $request->tanggal,
        ];
        
        $request->validate([
            'kejadian' => 'required|string|max:255',
            'staff' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|string|max:255',
            'keunggulan' => 'required|string|max:255',
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

        return redirect('/kejadian/show/'.$newRowData['id_kejadian']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        DB::table('kelahiran')->where('id_kelahiran', $id)->delete();
        return redirect('/kelahiran');
    }
}
