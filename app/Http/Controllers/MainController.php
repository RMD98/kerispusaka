<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
class MainController extends Controller
{
    //
    function index(){
        $data = DB::table('users')->where('role','dokter')->join('staff','users.id_user','staff.id_staff')->get();
        $admin = DB::table('users')->where('role','petugas')->join('staff','users.id_user','staff.id_staff')->get();
        return view('home',compact('data','admin'));
    }
    function downloadPdf($id){
        $data = DB::table('kejadian')->where('id_kejadian', $id)->first();
        $peternak = DB::table('peternak')->where('id_peternak', $data->id_peternak)->first();
        $betina = DB::table('betina')->where('ear_tag', $data->id_betina)->first();
        // dd($data);
        $ib = DB::table('ib')->where('id_kejadian', $id)->get();
        $pkb = DB::table('pkb')->where('id_kejadian', $id)->get();

        $kelahiran = DB::table('kelahiran')->where('id_kejadian', $id)->get();

        $pdf = Pdf::loadView('print', compact('data','ib','pkb','peternak','betina','kelahiran'))
            ->setPaper('a4', 'portrait'); // you can set 'landscape'
        return $pdf->download('report-'.$data->id_kejadian.'.pdf');
    }
    function printPdf($id){
        $data = DB::table('kejadian')->where('id_kejadian', $id)->first();
        $peternak = DB::table('peternak')->where('id_peternak', $data->id_peternak)->first();
        $betina = DB::table('betina')->where('ear_tag', $data->id_betina)->first();
        $ib = DB::table('ib')->where('id_kejadian', $id)->get();
        $pkb = DB::table('pkb')->where('id_kejadian', $id)->get();
        $kelahiran = DB::table('kelahiran')->where('id_kejadian', $id)->get();

        $pdf = Pdf::loadView('print', compact('data','ib','pkb','peternak','betina','kelahiran'))
                ->setPaper('a4', 'portrait');

        if (request()->has('download')) {
            return $pdf->download('report-'.$data->id_kejadian.'.pdf');
        }

        return $pdf->stream('report-'.$data->id_kejadian.'.pdf');
    }

}
    