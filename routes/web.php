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

    Route::get('users', [App\Http\Controllers\admin\UserController::class, 'users'])->name('users');  

    Route::get('adduser', [App\Http\Controllers\admin\UserController::class, 'adduser'])->name('adduser'); 

    Route::delete('deleteuser/{id}',[App\Http\Controllers\admin\UserController::class, 'destroy'])->name('delete_user');

   Route::get('getemployee', [App\Http\Controllers\admin\EmployeeController::class, 'getemployee'])->name('getemployee');      
    
    Route::post('/showemployees', [App\Http\Controllers\admin\EmployeeController::class, 'showemployees'])->name('showemployees');
        
    Route::get('categories', [App\Http\Controllers\admin\CategoryController::class, 'show'])->name('categories');  
    
    Route::get('/editcategories/{id}', [App\Http\Controllers\admin\CategoryController::class, 'edit'])->name('editcategory');    
    
    Route::patch('/updatecategories/{id}',[App\Http\Controllers\admin\CategoryController::class, 'update'])->name('updatecategory'); 
    
    Route::delete('deletecategories/{id}',[App\Http\Controllers\admin\CategoryController::class, 'destroy'])->name('delete_category');

    Route::get('/add_dcos_contact', [App\Http\Controllers\admin\DcosContactsController::class, 'index'])->name('add_dcos_contact'); 

    Route::post('/store_dcos_contact', [App\Http\Controllers\admin\DcosContactsController::class, 'create'])->name('store_dcos_contact');

    Route::get('dcos_contacts', [App\Http\Controllers\admin\DcosContactsController::class, 'show'])->name('dcos_contacts'); 

    Route::get('/edit_dcos_contact/{id}', [App\Http\Controllers\admin\DcosContactsController::class, 'edit'])->name('edit_dcos_contact');
    
    Route::patch('/update_dcos_contact/{id}',[App\Http\Controllers\admin\DcosContactsController::class, 'update'])->name('update_dcos_contact'); 

    Route::delete('delete_dcos_contact/{id}',[App\Http\Controllers\admin\DcosContactsController::class, 'destroy'])->name('delete_dcos_contact');  

    Route::get('user_type', [App\Http\Controllers\admin\UserController::class, 'index'])->name('user_type');      
        
    Route::post('/create_user_type', [App\Http\Controllers\admin\UserController::class, 'create'])->name('create_user_type');
        
    Route::get('user_types', [App\Http\Controllers\admin\UserController::class, 'show'])->name('user_types');  
    
    Route::get('/edituser_type/{id}', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('edituser_type');    
    
    Route::patch('/update_user_type/{id}',[App\Http\Controllers\admin\UserController::class, 'update'])->name('update_user_type'); 
    
    Route::delete('delete_user_type/{id}',[App\Http\Controllers\admin\UserController::class, 'delete'])->name('delete_user_type');

   Route::get('/addemployee', [App\Http\Controllers\admin\EmployeeController::class, 'index'])->name('addemployee'); 

    Route::post('/employeestore', [App\Http\Controllers\admin\EmployeeController::class, 'create'])->name('employeestore');

    Route::get('employees', [App\Http\Controllers\admin\EmployeeController::class, 'show'])->name('employees'); 

    Route::get('/editemployee/{id}', [App\Http\Controllers\admin\EmployeeController::class, 'edit'])->name('editemployee');
    
    Route::patch('/updateemployee/{id}',[App\Http\Controllers\admin\EmployeeController::class, 'update'])->name('updateemployee'); 

    Route::delete('deleteemployee/{id}',[App\Http\Controllers\admin\EmployeeController::class, 'destroy'])->name('deleteemployee');  
    
    Route::get('/attendance-create', [App\Http\Controllers\admin\AttendanceController::class, 'index'])->name('addattendance'); 

    Route::post('/attendance-store', [App\Http\Controllers\admin\AttendanceController::class, 'create'])->name('attendance-store');

    Route::get('attendance', [App\Http\Controllers\admin\AttendanceController::class, 'show'])->name('attendance'); 

    Route::get('/editattendance/{id}', [App\Http\Controllers\admin\AttendanceController::class, 'edit'])->name('editattendance');
    
    Route::patch('/updateattendance/{id}',[App\Http\Controllers\admin\AttendanceController::class, 'update'])->name('updateattendance'); 

    Route::delete('deleteattendance/{id}',[App\Http\Controllers\admin\AttendanceController::class, 'destroy'])->name('delete_attendance');
    
    Route::get('contact_detail', [App\Http\Controllers\admin\ClientsController::class, 'view'])->name('contact_detail'); 

    Route::delete('deletecontact/{id}',[App\Http\Controllers\admin\ClientsController::class, 'delete'])->name('deletecontact');
    
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
