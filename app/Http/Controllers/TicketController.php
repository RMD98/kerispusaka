<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $test = DB::table('ticket')->get();
        // dd($test);
        if(auth()->user()->role == 'super admin'){
            $data = DB::table('ticket')
                    ->join('staff','ticket.id_staff','staff.id_staff')
                    ->join('peternak','peternak.id_peternak','ticket.id_peternak')
                    ->select('ticket.*', 'peternak.nama as pelapor', 'staff.nama as petugas')->orderBy('ticket.id_ticket', 'desc')->paginate(10);
        }else{
            
            $data = DB::table('ticket')
                    ->where('ticket.id_staff',auth()->user()->id_user)
                    ->join('staff','ticket.id_staff','staff.id_staff')
                    ->join('peternak','peternak.id_peternak','ticket.id_peternak')
                    ->select('ticket.*', 'peternak.nama as pelapor', 'staff.nama as petugas')->orderBy('ticket.id_ticket', 'desc')->paginate(10);
        }
        // dd($data);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return view('ticket.ticket',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ticket.add_ticket');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'staff'=>'required|string|max:255',
            'peternak' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        $id = DB::table('ticket')->orderBy('id_ticket', 'desc')->first();
        $year = Carbon::now()->format('Y.m');
        if($id == null){
            $id = '001';
        }else{
            if(substr($id->id_ticket, strrpos($id->id_ticket, '-') + 1,7) != $year){
                $id = 1;
            }else{
                $numb = explode('-', $id->id_ticket)[1];
                $id = explode('.', $numb)[2] + 1;
            }
        }
        $data = [
            'id_ticket' => 'Laporan-'.$year.'.'.sprintf('%03d', $id),
            'id_peternak' => $request->peternak,
            'id_staff' => $request->staff,
            'jenis_laporan' => $request->jenis,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        DB::table('ticket')->insert($data);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'ticket',
            'primary_key' => $data['id_ticket'],
            'row'         => $data
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect()->route('ticket.index')->with('success','Ticket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function table(string $id){
        $ticket = DB::table('ticket')
                ->join('staff','ticket.id_staff','staff.id_staff')
                ->join('peternak','peternak.id_peternak','ticket.id_peternak')
                ->select('ticket.*', 'peternak.nama as pelapor', 'staff.nama as petugas')
                ->where('ticket.id_peternak',$id)
                ->get();
        // dd($data);
        return view('ticket.ticket_table',compact('ticket')); 
    }
    public function checklimit(string $id)
    {
        //
        $data = DB::table('ticket')->where('id_peternak', $id)->whereDate('created_at',Carbon::today())->count();
        // dd($data);
        return response()->json($data);
    }
    public function updateStatus(Request $request)
    {
        //
        DB::table('ticket')->where('id_ticket',$request->id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);
         fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'ticket',
            'primary_key' => 'id_ticket',
            'row'         => ['id_ticket' => $request->id, 'status' => $request->status, 'updated_at' => now()],
        ]);
        return redirect()->route('ticket.index')->with('success','Status ticket berhasil diupdate');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $query = DB::table('ticket')
                ->join('peternak', 'ticket.id_peternak', '=', 'peternak.id_peternak')
                ->where('id_ticket', 'like', "%{$search}%");
        if($request->has('jenis')){
            $query->where('jenis_laporan', $request->input('jenis'));
        if($request->has('kejadian')){
            $kejadian = DB::table('kejadian')->where('id_kejadian', $request->input('kejadian'))->first();
            $query->where('ticket.id_peternak', $kejadian->id_peternak);
            }
            
        }else{
            $query->orWhere('peternak.nama','like',"%{$search}%");
        }
        
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
        $data = $query->select('ticket.id_ticket',DB::raw("CONCAT(ticket.id_ticket,'-',peternak.nama)as text"),'peternak.*')->get();

        return response()->json($data);
    }
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
        $data = DB::table('ticket')->where('id_ticket',$id)
                ->join('staff','ticket.id_staff','=','staff.id_staff')
                ->join('peternak','ticket.id_peternak','=','peternak.id_peternak')
                ->select('ticket.*', 'peternak.nama as peternak', 'staff.nama as staff')
                ->first();
        return view('ticket.edit_ticket',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'staff'=>'required|string|max:255',
            'peternak' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $data = [
            'id_peternak' => $request->peternak,
            'id_staff' => $request->staff,
            'jenis_laporan' => $request->jenis,
            'status' => $request->status,
            'created_at' => $request->tanggal,
            'updated_at' => now(),
        ];

        DB::table('ticket')->where('id_ticket',$id)->update($data);
         fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'update',
            'table'       => 'ticket',
            'primary_key' => 'id_ticket',
            'row'         => array_merge(['id_ticket'=>$id],$data),
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect()->route('ticket.index')->with('success','Ticket berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        //
        DB::table('ticket')->where('id_ticket',$id)->delete();
         fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'delete',
            'table'       => 'ticket',
            'primary_key' => 'id_ticket',
            'row'         => ['id_ticket' => $id],
        ]);
        if ($request->expectsJson()) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        };
        return redirect()->route('ticket.index')->with('success','Ticket berhasil dihapus');
    }
}
