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
    
    Route::get('/add_useful_link', [App\Http\Controllers\admin\UsefulLinkController::class, 'index'])->name('add_useful_link'); 

    Route::post('/store_useful_link', [App\Http\Controllers\admin\UsefulLinkController::class, 'create'])->name('store_useful_link');

    Route::get('useful_links', [App\Http\Controllers\admin\UsefulLinkController::class, 'show'])->name('useful_links'); 

    Route::get('/edit_useful_link/{id}', [App\Http\Controllers\admin\UsefulLinkController::class, 'edit'])->name('edit_useful_link');
    
    Route::patch('/update_useful_link/{id}',[App\Http\Controllers\admin\UsefulLinkController::class, 'update'])->name('update_useful_link'); 

    Route::delete('delete_useful_link/{id}',[App\Http\Controllers\admin\UsefulLinkController::class, 'destroy'])->name('delete_useful_link');

    Route::get('/add_public_notice', [App\Http\Controllers\admin\PublicNoticesController::class, 'index'])->name('add_public_notice'); 

    Route::post('/store_public_notice', [App\Http\Controllers\admin\PublicNoticesController::class, 'create'])->name('store_public_notice');

    Route::get('public_notices', [App\Http\Controllers\admin\PublicNoticesController::class, 'show'])->name('public_notices'); 

    Route::get('/edit_public_notice/{id}', [App\Http\Controllers\admin\PublicNoticesController::class, 'edit'])->name('edit_public_notice');
    
    Route::patch('/update_public_notice/{id}',[App\Http\Controllers\admin\PublicNoticesController::class, 'update'])->name('update_public_notice'); 

    Route::delete('delete_public_notice/{id}',[App\Http\Controllers\admin\PublicNoticesController::class, 'destroy'])->name('delete_public_notice');

    Route::get('/add_department', [App\Http\Controllers\admin\DepartmentController::class, 'index'])->name('add_department'); 

    Route::post('/store_department', [App\Http\Controllers\admin\DepartmentController::class, 'create'])->name('store_department');

    Route::get('departments', [App\Http\Controllers\admin\DepartmentController::class, 'show'])->name('departments'); 

    Route::get('/edit_department/{id}', [App\Http\Controllers\admin\DepartmentController::class, 'edit'])->name('edit_department');
    
    Route::patch('/update_department/{id}',[App\Http\Controllers\admin\DepartmentController::class, 'update'])->name('update_department'); 

    Route::delete('delete_department/{id}',[App\Http\Controllers\admin\DepartmentController::class, 'destroy'])->name('delete_department');

    Route::get('/add_advertisement_rate', [App\Http\Controllers\admin\AdvertisementRateController::class, 'index'])->name('add_advertisement_rate'); 

    Route::post('/store_advertisement_rate', [App\Http\Controllers\admin\AdvertisementRateController::class, 'create'])->name('store_advertisement_rate');

    Route::get('advertisement_rates', [App\Http\Controllers\admin\AdvertisementRateController::class, 'show'])->name('advertisement_rates'); 

    Route::get('/edit_advertisement_rate/{id}', [App\Http\Controllers\admin\AdvertisementRateController::class, 'edit'])->name('edit_advertisement_rate');
    
    Route::patch('/update_advertisement_rate/{id}',[App\Http\Controllers\admin\AdvertisementRateController::class, 'update'])->name('update_advertisement_rate'); 

    Route::delete('delete_advertisement_rate/{id}',[App\Http\Controllers\admin\AdvertisementRateController::class, 'destroy'])->name('delete_advertisement_rate');

    Route::get('/add_scheme', [App\Http\Controllers\admin\SchemeController::class, 'index'])->name('add_scheme'); 

    Route::post('/store_scheme', [App\Http\Controllers\admin\SchemeController::class, 'create'])->name('store_scheme');

    Route::get('schemes', [App\Http\Controllers\admin\SchemeController::class, 'show'])->name('schemes'); 

    Route::get('/edit_scheme/{id}', [App\Http\Controllers\admin\SchemeController::class, 'edit'])->name('edit_scheme');
    
    Route::patch('/update_scheme/{id}',[App\Http\Controllers\admin\SchemeController::class, 'update'])->name('update_scheme'); 

    Route::delete('delete_scheme/{id}',[App\Http\Controllers\admin\SchemeController::class, 'destroy'])->name('delete_scheme');
    
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
