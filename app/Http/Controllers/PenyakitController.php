<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('penyakit')
                ->join('ticket', 'penyakit.id_ticket', 'ticket.id_ticket')
                ->join('peternak', 'ticket.id_peternak','peternak.id_peternak')
                ->get();
        //
        return view('penyakit.penyakit', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('penyakit.add_penyakit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'ticket'=>'required|string|max:255',
            'peternak' => 'required|string|max:255',
            'sapi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);
        $id = DB::table('penyakit')->orderBy('id_penyakit', 'desc')->first();
        $year = Carbon::now()->format('y.m');
        if($id == null){
            $id = '001';
        }else{
            if(substr($id->id_penyakit, strrpos($id->id_penyakit, '-') + 1,5) != $year){
                $id = 1;
            }else{
                $numb = explode('-', $id->id_penyakit)[1];
                $id = explode('.', $numb)[2] + 1;
            }
        }
        $newRowData = array(
            'id_penyakit' => 'Penyakit-'.$year.'.'.sprintf('%03d', $id),
            'id_ticket' => $request->ticket,
            'id_sapi' => $request->sapi,
            'keterangan' => $request->keterangan,
            'created_at' => $request->tanggal,
        );
        // dd($newRowData);
        DB::table('penyakit')->insert($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'penyakit',
            'primary_key' => $newRowData['id_penyakit'],
            'row'         => $newRowData
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };

        return redirect()->route('penyakit.index')->with('success', 'Penanganan Penyakit added successfully.');
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
        $data = DB::table('penyakit')->where('id_penyakit',$id)
                    ->join('ticket', 'penyakit.id_ticket', 'ticket.id_ticket')
                    ->join('peternak','ticket.id_peternak','peternak.id_peternak')
                    ->join('betina','betina.id_peternak','peternak.id_peternak')
                    ->select('penyakit.*','ticket.id_peternak','betina.ear_tag','peternak.nama as nama','betina.nama as nama_sapi')
                    ->first();

        return view('penyakit.edit_penyakit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'ticket'=>'required|string|max:255',
            'peternak' => 'required|string|max:255',
            'sapi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);
        $newRowData = array(
            'id_ticket' => $request->ticket,
            'id_sapi' => $request->sapi,
            'keterangan' => $request->keterangan,
            'created_at' => $request->tanggal,
        );
        // dd($newRowData);
        DB::table('penyakit')->where('id_penyakit',$id)->update($newRowData);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'penyakit',
            'primary_key' => 'id_penyakit',
            'row'         => array_merge(['id_penyakit'=>$id],$newRowData)
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $newRowData
            ]);
        };

        return redirect()->route('penyakit.index')->with('success', 'Penanganan Penyakit added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('penyakit')->where('id_penyakit',$id)->delete();
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'penyakit',
            'primary_key' => 'id_penyakit',
            'row'         => [
                'id_penyakit' => $id,
            ]
        ]);
    }

}
