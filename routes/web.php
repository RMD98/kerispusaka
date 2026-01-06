<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\IbController;
use App\Http\Controllers\PkbController;
use App\Http\Controllers\PeternakController;
use App\Http\Controllers\BetinaController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\PejantanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard')->middleware([]);
// });

// Route::get('/', function () {
//     return view('home-v1-bjr-plt');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/',function(){
//     return view('auth.login-old');
// });
Route::middleware('auth')->group(function () {
    // Route::get('/',function(){
    //     return view('ticket.ticket');
    // })->name('dashboard');
    Route::get('/checklimit/{id}',[TicketController::class,'checklimit'])->name('ticket.checklimit');
    Route::get('/ticket/table/{id}',[TicketController::class,'table'])->name('ticket.table');
    Route::middleware('exclude_role')->group(function () {  
        Route::get('/', [TicketController::class, 'index'])->name('dashboard');
        Route::delete('/ticket/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
        Route::get('/edit_ticket/{id}', [TicketController::class, 'edit'])->name('ticket.edit');
        Route::post('/edit_ticket/{id}', [TicketController::class, 'update'])->name('ticket.update');
        Route::get('/add_ticket',[TicketController::class,'create'])->name('ticket.create');
        Route::post('/add_ticket',[TicketController::class,'store'])->name('ticket.store');
        Route::post('/update_status',[TicketController::class,'updateStatus'])->name('ticket.updateStatus');
        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/staff', [StaffController::class,'index'])->name('staff.index');
        Route::delete('/staff', [StaffController::class,'destroy'])->name('staff.destroy');
        Route::get('/edit_staff/{id}', [StaffController::class,'edit'])->name('staff.edit');
        Route::put('/update_staff/{id}', [StaffController::class,'update'])->name('staff.update');
        Route::get('/staff/search', [StaffController::class,'search'])->name('staff.search');
        Route::get('/add_staff',[StaffController::class,'create'])->name('staff.create');
        Route::post('/add_staff',[StaffController::class,'store'])->name('staff.store');

        Route::get('/kejadian',[KejadianController::class,'index'])->name('kejadian.index');
        Route::get('/kejadian/show/{id}',[KejadianController::class,'show'])->name('kejadian.show');
        Route::get('/kejadian/search',[KejadianController::class,'search'])->name('kejadian.search');
        Route::get('/add_kejadian',[KejadianController::class,'create'])->name('kejadian.create');
        Route::post('/add_kejadian',[KejadianController::class,'store'])->name('kejadian.store');
        Route::delete('/kejadian/{id}',[KejadianController::class,'destroy'])->name('kejadian.destroy');
        Route::get('/edit_kejadian/{id}',[KejadianController::class,'edit'])->name('kejadian.edit');
        Route::post('/edit_kejadian/{id}',[KejadianController::class,'update'])->name('kejadian.update');
        
        Route::get('/ib',[IbController::class,'index'])->name('ib.index');
        Route::get('/ib/search',[IbController::class,'search'])->name('ib.search');
        Route::delete('/ib/{id}',[IbController::class,'destroy'])->name('ib.destroy');
        Route::get('/add_ib/{id?}',[IbController::class,'create'])->name('ib.create');
        Route::post('/add_ib/{id?}',[IbController::class,'store'])->name('ib.store');
        Route::get('/edit_ib/{id}',[IbController::class,'edit'])->name('ib.edit');
        Route::put('/update_ib/{id}',[IbController::class,'update'])->name('ib.update');
        
        Route::get('/pkb',[PkbController::class,'index'])->name('pkb.index');
        Route::get('/pkb/search',[PkbController::class,'search'])->name('pkb.search');
        Route::delete('/pkb/{id}',[PkbController::class,'destroy'])->name('pkb.destroy');
        Route::get('/edit_pkb/{id}',[PkbController::class,'edit'])->name('pkb.edit');
        Route::put('/update_pkb/{id}',[PkbController::class,'update'])->name('pkb.update');
        Route::get('/add_pkb/{id?}',[PkbController::class,'create'])->name('pkb.create');
        Route::post('/add_pkb/{id?}',[PkbController::class,'store'])->name('pkb.store');
        
        Route::get('/kelahiran',[KelahiranController::class,'index'])->name('kelahiran.index');
        Route::delete('/kelahiran',[KelahiranController::class,'destroy'])->name('kelahiran.destroy');
        Route::get('/add_kelahiran/{id?}',[KelahiranController::class,'create'])->name('kelahiran.create');
        Route::post('/add_kelahiran/{id?}',[KelahiranController::class,'store'])->name('kelahiran.store');
        Route::get('/edit_kelahiran/{id}',[KelahiranController::class,'edit'])->name('kelahiran.edit');
        Route::post('/update_kelahiran/{id}',[KelahiranController::class,'update'])->name('kelahiran.update');
        
        Route::get('/peternak',[PeternakController::class,'index'])->name('peternak.index');
        Route::delete('/peternak/{id}',[PeternakController::class,'destroy'])->name('peternak.destroy');
        Route::get('/edit_peternak/{id}',[PeternakController::class,'edit'])->name('peternak.edit');
        Route::put('/update_peternak/{id}',[PeternakController::class,'update'])->name('peternak.update');
        Route::get('/peternak/search',[PeternakController::class,'search'])->name('peternak.search');
        Route::get('/add_peternak',[PeternakController::class,'create'])->name('peternak.create');
        Route::post('/add_peternak',[PeternakController::class,'store'])->name('peternak.store');
        
        Route::get('/pejantan',[PejantanController::class,'index'])->name('pejantan.index');
        Route::delete('/pejantan/{id}',[PejantanController::class,'destroy'])->name('pejantan.destroy');
        Route::get('/add_pejantan',[PejantanController::class,'create'])->name('pejantan.create');
        Route::post('/add_pejantan',[PejantanController::class,'store'])->name('pejantan.store');
        Route::get('/edit_pejantan/{id}',[PejantanController::class,'edit'])->name('pejantan.edit');
        Route::put('/update_pejantan/{id}',[PejantanController::class,'update'])->name('pejantan.update');
        Route::get('/pejantan/search',[PejantanController::class,'search'])->name('pejantan.search');
        
        Route::get('/betina',[BetinaController::class,'index'])->name('betina.index');
        Route::delete('/betina/{id}',[BetinaController::class,'destroy'])->name('betina.destroy');
        Route::get('/add_betina',[BetinaController::class,'create'])->name('betina.create');
        Route::post('/add_betina',[BetinaController::class,'store'])->name('betina.store');
        Route::get('/edit_betina/{id}',[BetinaController::class,'edit'])->name('betina.edit');
        Route::put('/update_betina/{id}',[BetinaController::class,'update'])->name('betina.update');
        Route::get('/betina/search',[BetinaController::class,'search'])->name('betina.search');
        
        Route::get('/print_pdf/{id}',[MainController::class,'printPdf'])->name('print.pdf');
        Route::get('/user',[UserController::class,'index'])->name('user.index');
    });
    Route::get('/home', [MainController::class, 'index'])->name('home');
    Route::get('/call',[CallController::class,'index'])->name('call.index');
    Route::post('/call',[CallController::class,'startCall'])->name('call.start');
    Route::post('/twiml',[CallController::class,'twiml'])->name('call.twiml');
    Route::post('/send-message',[CallController::class,'sendMessage'])->name('call.sendMessage');
});

require __DIR__.'/auth.php';
