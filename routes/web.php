<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'admin','prefix'=>'cms-admin', 'middleware' => ['auth', 'verified']], function() {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/add_dcos_contact', [App\Http\Controllers\admin\DcosContactsController::class, 'index'])->name('add_dcos_contact'); 

    Route::post('/store_dcos_contact', [App\Http\Controllers\admin\DcosContactsController::class, 'create'])->name('store_dcos_contact');

    Route::get('dcos_contacts', [App\Http\Controllers\admin\DcosContactsController::class, 'show'])->name('dcos_contacts'); 

    Route::get('/edit_dcos_contact/{id}', [App\Http\Controllers\admin\DcosContactsController::class, 'edit'])->name('edit_dcos_contact');
    
    Route::patch('/update_dcos_contact/{id}',[App\Http\Controllers\admin\DcosContactsController::class, 'update'])->name('update_dcos_contact'); 

    Route::delete('delete_dcos_contact/{id}',[App\Http\Controllers\admin\DcosContactsController::class, 'destroy'])->name('delete_dcos_contact');  

    Route::get('/add_govt_scheme', [App\Http\Controllers\admin\GovtSchemesController::class, 'index'])->name('add_govt_scheme'); 

    Route::post('/store_govt_scheme', [App\Http\Controllers\admin\GovtSchemesController::class, 'create'])->name('store_govt_scheme');

    Route::get('govt_schemes', [App\Http\Controllers\admin\GovtSchemesController::class, 'show'])->name('govt_schemes'); 

    Route::get('/edit_govt_scheme/{id}', [App\Http\Controllers\admin\GovtSchemesController::class, 'edit'])->name('edit_govt_scheme');
    
    Route::patch('/update_govt_scheme/{id}',[App\Http\Controllers\admin\GovtSchemesController::class, 'update'])->name('update_govt_scheme'); 

    Route::delete('delete_govt_scheme/{id}',[App\Http\Controllers\admin\GovtSchemesController::class, 'destroy'])->name('delete_govt_scheme');  
    
    });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
