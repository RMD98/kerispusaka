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

class BetinaController extends Controller
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
            'sheet' => $content->getSheetByName('betina'),
            'localPath' => $file['path'],
            'file' => $file['file'],
        ];
    }

    public function index()
    {
      

        if(auth()->user()->role == 'super admin'){
            $data = DB::table('betina')->get();
        }else if(auth()->user()->role == 'peternak'){
            
            $data = DB::table('betina')
                    ->join('peternak','betina.id_peternak','peternak.id_peternak')
                    ->where('peternak.id_peternak','=',auth()->user()->id_user)
                    ->select('betina.*')
                    ->get();
        }
        return view('betina.betina',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   
        return view('betina.add_betina');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $path = $file->storeAs('public/betina', $filename);
            $file->move(public_path('gambar_sapi/betina'), $filename);
            $fotoPath = 'gambar_sapi/betina/'.$filename;
        } else {
            $fotoPath = null; // or set a default value if needed
        }
        $newRowData = [
            'ear_tag' => $request->eartag,
            'nama' => $request->nama,
            'id_peternak' => $request->peternak,
            'jenis_sapi' => $request->jenis,
            'tanggal_lahir' => $request->tanggal,
            // 'usia' => new Carbon($request->tanggal)->diffInYears(Carbon::now()),
            'usia' => Carbon::parse($request->tanggal)->age,
            'jumlah_ib' => $request->jumlah_ib ?? 0,
            'riwayat_penyakit' =>$request->riwayat,
            'status' =>$request->status,
            'foto' => $fotoPath,
            'created_at' => Carbon::now(),
        ];
        $request->validate([
            'nama' => 'required|string|max:255',
            'peternak' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
   
        // $prefix = 'BETINA';
        // $year = Carbon::now()->format('Y');
        // $padLength = 4;
        // $count = DB::table('betina')->count();
        // if($count == 0){
        //     $newRowData['id_betina'] = "{$prefix}-{$year}-0001";
        // }else{
        //     $lastRow = DB::table('betina')->orderBy('id_betina', 'desc')->first();
        //     $lastId = $lastRow->id_betina;
        //     $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
        //     $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        //     $newRowData['id_betina'] = "{$prefix}-{$year}-{$nextNumber}";
        // };
        DB::table('betina')->insert($newRowData);
      

        return redirect('/betina')->with('success', 'Data Betina Berhasil Ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        $peternak = $request->get('peternak');
       
        $data = DB::table('betina')
            ->Where('id_peternak','like', "%{$peternak}%")
            ->where('nama', 'like', "%{$search}%")
            ->Where('ear_tag', 'like', "%{$search}%")
            // ->Where('jenis_sapi', 'like', "%{$search}%")
            // ->Where('tanggal_lahir', 'like', "%{$search}%")
            ->select('betina.*',DB::raw("CONCAT(ear_tag,'-',nama) as text"))
            ->get();
        
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
        $data = DB::table('betina')->where('ear_tag', $id)->first();
        return view('betina.edit_betina', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $newRowData = [
            'ear_tag' => $request->eartag,
            'nama' => $request->nama,
            'id_peternak' => $request->peternak,
            'jenis_sapi' => $request->jenis,
            'tanggal_lahir' => $request->tanggal,
            // 'usia' => new Carbon($request->tanggal)->diffInYears(Carbon::now()),
            'usia' => Carbon::parse($request->tanggal)->age,
            'jumlah_ib' => $request->jumlah_ib ?? 0,
            'riwayat_penyakit' =>$request->riwayat,
            'status' =>$request->status,
            'updated_at' => Carbon::now(),
        ];
         if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $path = $file->storeAs('public/betina', $filename);
            $file->move(public_path('gambar_sapi/betina'), $filename);
            $fotoPath = 'gambar_sapi/betina/'.$filename;
            $newRowData['foto'] = $fotoPath;
        } else {
            $fotoPath = null; // or set a default value if needed
        }
        $request->validate([
            'eartag' => 'required|string|max:255|unique:betina,ear_tag,'.$id.',ear_tag',
            'nama' => 'required|string|max:255',
            'peternak' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'tanggal' => 'required|string|max:15',
        ]);
   
        // $prefix = 'BETINA';
        // $year = Carbon::now()->format('Y');
        // $padLength = 4;
        // $count = DB::table('betina')->count();
        // if($count == 0){
        //     $newRowData['id_betina'] = "{$prefix}-{$year}-0001";
        // }else{
        //     $lastRow = DB::table('betina')->orderBy('id_betina', 'desc')->first();
        //     $lastId = $lastRow->id_betina;
        //     $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
        //     $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        //     $newRowData['id_betina'] = "{$prefix}-{$year}-{$nextNumber}";
        // };
        DB::table('betina')->where('ear_tag',$id)->update($newRowData);
        return redirect('/betina')->with('success', 'Data Betina Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('betina')->where('ear_tag',$id)->delete();
        return redirect('/betina')->with('success', 'Data Betina Berhasil Dihapus');
    }
}
