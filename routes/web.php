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
    
    Route::get('/add_bank_branch', [App\Http\Controllers\admin\BankBranchesController::class, 'index'])->name('add_bank_branch'); 

    Route::post('/store_bank_branch', [App\Http\Controllers\admin\BankBranchesController::class, 'create'])->name('store_bank_branch');

    Route::get('bank_branches', [App\Http\Controllers\admin\BankBranchesController::class, 'show'])->name('bank_branches'); 

    Route::get('/edit_bank_branch/{id}', [App\Http\Controllers\admin\BankBranchesController::class, 'edit'])->name('edit_bank_branch');
    
    Route::patch('/update_bank_branch/{id}',[App\Http\Controllers\admin\BankBranchesController::class, 'update'])->name('update_bank_branch'); 

    Route::delete('delete_bank_branch/{id}',[App\Http\Controllers\admin\BankBranchesController::class, 'destroy'])->name('delete_bank_branch');
    
    Route::get('/add_service', [App\Http\Controllers\admin\ServicesController::class, 'index'])->name('add_service'); 

    Route::post('/store_service', [App\Http\Controllers\admin\ServicesController::class, 'create'])->name('store_service');

    Route::get('services', [App\Http\Controllers\admin\ServicesController::class, 'show'])->name('services'); 

    Route::get('/edit_service/{id}', [App\Http\Controllers\admin\ServicesController::class, 'edit'])->name('edit_service');
    
    Route::patch('/update_service/{id}',[App\Http\Controllers\admin\ServicesController::class, 'update'])->name('update_service'); 

    Route::delete('delete_service/{id}',[App\Http\Controllers\admin\ServicesController::class, 'destroy'])->name('delete_service'); 
    
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
