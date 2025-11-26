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
    public function index()
    {
        //
        
        if(auth()->user()->role == 'super admin'){
            $data = DB::table('ticket')
                    ->join('staff','ticket.id_staff','staff.id_staff')
                    ->join('peternak','peternak.id_peternak','ticket.id_user')
                    ->select('ticket.*', 'peternak.nama as pelapor', 'staff.nama as petugas')->get();
        }else{
            
            $data = DB::table('ticket')
                    ->where('ticket.id_staff',auth()->user()->id_user)
                    ->join('staff','ticket.id_staff','staff.id_staff')
                    ->join('peternak','peternak.id_peternak','ticket.id_user')
                    ->select('ticket.*', 'peternak.nama as pelapor', 'staff.nama as petugas')->get();
        }
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

        $data = [
            'id_ticket' => 'TKT-'.time(),
            'id_user' => $request->peternak,
            'id_staff' => $request->staff,
            'jenis_laporan' => $request->jenis,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // $prefix = 'TICKET';
        // $year = Carbon::now()->format('Y');
        // $padLength = 4;

        // $count = DB::table('ticket')->count();
        // if($count == 0){
        //     $data['id_ticket'] = "{$prefix}-{$year}-0001";
        // }else{
        //     $lastRow = DB::table('ticket')->orderBy('id_ticket', 'desc')->first();
        //     $lastId = $lastRow->id_ticket;
        //     $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
        //     $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        //     $data['id_ticket'] = "{$prefix}-{$year}-{$nextNumber}";
        // };
        // dd($data);

        DB::table('ticket')->insert($data);
        return redirect()->route('dashboard')->with('success','Ticket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function table(string $id){
        $ticket = DB::table('ticket')
                ->join('staff','ticket.id_staff','staff.id_staff')
                ->join('peternak','peternak.id_peternak','ticket.id_user')
                ->select('ticket.*', 'peternak.nama as pelapor', 'staff.nama as petugas')
                ->where('ticket.id_user',$id)
                ->get();
        // dd($data);
        return view('ticket.ticket_table',compact('ticket')); 
    }
    public function checklimit(string $id)
    {
        //
        $data = DB::table('ticket')->where('id_user', $id)->whereDate('created_at',Carbon::today())->count();
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
        return redirect()->route('dashboard')->with('success','Status ticket berhasil diupdate');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('ticket')->where('id_ticket',$id)->delete();
        return redirect()->route('dashboard')->with('success','Ticket berhasil dihapus');
    }
}
