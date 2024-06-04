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
Route::get('/', [App\Http\Controllers\frontend\IndexController::class, 'index'])->name('index');

Route::get('/apply-loan', [App\Http\Controllers\frontend\IndexController::class, 'applyLoan'])->name('apply-loan');

Route::get('/reload-captcha', [App\Http\Controllers\frontend\IndexController::class, 'reloadCaptcha'])->name('reloadCaptcha');

Route::post('/get-bank-branches-by-bank-name', [App\Http\Controllers\frontend\IndexController::class, 'getBankBranchesByBankName'])->name('get-bank-branches-by-bank-name');

Route::post('/save-apply-loan', [App\Http\Controllers\frontend\IndexController::class, 'saveApplyLoan'])->name('saveApplyLoan');

Route::match(['get', 'post'], '/apply-loan-otp/{phoneNumber}', [App\Http\Controllers\frontend\IndexController::class, 'applyLoanOtp'])->name('applyLoanOtp');

Route::match(['get', 'post'], '/verify-otp/{phoneNumber}', [App\Http\Controllers\frontend\IndexController::class, 'verifyOtp'])->name('verifyOtp');

Route::get('/track-loan-status', [App\Http\Controllers\frontend\IndexController::class, 'trackLoanStatus'])->name('track-loan-status');

Route::post('/show-loan-status', [App\Http\Controllers\frontend\IndexController::class, 'show_loan_status'])->name('show-loan-status');

Route::match(['get', 'post'], '/track-loan-otp/{phoneNumber}', [App\Http\Controllers\frontend\IndexController::class, 'trackLoanOtp'])->name('trackLoanOtp');

Route::post('/verify_track_loan_otp', [App\Http\Controllers\frontend\IndexController::class, 'verify_track_loan_otp'])->name('verify_track_loan_otp');

Route::post('/update-otp', [App\Http\Controllers\frontend\IndexController::class, 'updateOtp'])->name('updateOtp');

//Route::post('update-otp', 'ApplyLoanController@updateOtp')->name('updateOtp');

Route::get('/sendmessages/{applicantId}', [App\Http\Controllers\ChatController::class, 'messagesSend'])->name('messSend');

Route::post('/messages/store/{applicantId}', [App\Http\Controllers\ChatController::class, 'messagesStore'])->name('messStore');

Route::get('/about-us', [App\Http\Controllers\frontend\IndexController::class, 'aboutUs'])->name('about-us');

Route::get('/contact-us', [App\Http\Controllers\frontend\IndexController::class, 'contactUs'])->name('contact-us');

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/apply-loan', function () {
//     return view('frontend/apply-loan');
// });
// Route::get('/apply-loan-otp', function () {
//     return view('frontend/apply-loan-otp');
// });
// Route::get('/track-loan-status', function () {
//     return view('frontend/track-loan-status');
// });
// Route::get('/about-us', function () {
//     return view('frontend/about-us');
// });
// Route::get('/contact-us', function () {
//     return view('frontend/contact-us');
// });
// Route::middleware('auth.bank_nodal')->group(function () {
//     // Your routes here
// });

Route::middleware('auth:bank_nodals')->prefix('bank-nodals')->namespace('Admin')->group(function () {
    Route::middleware('check_user_role:2')->group(function () {
// Route::group(['namespace' => 'admin','prefix'=>'bank-nodals', 'middleware' => ['auth', 'verified', 'check_user_type:bank_nodal']], function() {
        Route::get('/', [App\Http\Controllers\BankNodalsController::class, 'bankNodalDashboard'])->name('bank_nodals_dashboard');

    // Route::get('/add_bank_nodal', [App\Http\Controllers\BankNodalsController::class, 'index'])->name('add_bank_nodal'); 

    // Route::post('/store_bank_nodal', [App\Http\Controllers\BankNodalsController::class, 'create'])->name('store_bank_nodal');

    Route::get('bank_nodals', [App\Http\Controllers\BankNodalsController::class, 'show'])->name('bank_nodals'); 

    Route::get('/edit_bank_nodal/{id}', [App\Http\Controllers\BankNodalsController::class, 'edit'])->name('edit_bank_nodal');
    
    Route::patch('/update_bank_nodal/{id}',[App\Http\Controllers\BankNodalsController::class, 'update'])->name('update_bank_nodal');

    Route::get('filterapplyloan', [App\Http\Controllers\BankNodalsController::class, 'filterapplyloan'])->name('filterapplyloan');

    Route::get('/applicants/{applicant}/view', [App\Http\Controllers\BankNodalsController::class, 'view'])->name('applicant.view');
    
    
    Route::get('/sendmessages/{applicantId}', [App\Http\Controllers\BankNodalsController::class, 'messagesSend'])->name('messageSend');

    Route::post('/messages/store/{applicantId}', [App\Http\Controllers\BankNodalsController::class, 'messagesStore'])->name('messageStore');

// });
});
});

Route::middleware('auth:bank_branches')->prefix('bank-branches')->namespace('Admin')->group(function () {
    Route::middleware('check_user_role:3')->group(function () {
Route::get('/', [App\Http\Controllers\BankBranchController::class, 'bankBranchDashboard'])->name('bank_branches_dashboard'); 

    // Route::get('/add-branch', [App\Http\Controllers\BankBranchController::class, 'index'])->name('add-branch'); 

    // Route::post('/store-branch', [App\Http\Controllers\BankBranchController::class, 'create'])->name('store-branch');

    Route::get('branches', [App\Http\Controllers\BankBranchController::class, 'show'])->name('branches'); 

    Route::get('/edit-branch/{id}', [App\Http\Controllers\BankBranchController::class, 'edit'])->name('edit-branch');
    
    Route::patch('/update-branch/{id}',[App\Http\Controllers\BankBranchController::class, 'update'])->name('update-branch');
    
    Route::get('filter-apply-loan', [App\Http\Controllers\BankBranchController::class, 'filterapplyloan'])->name('filter-apply-loan');

    Route::get('/applicant/{applicant}/view', [App\Http\Controllers\BankBranchController::class, 'view'])->name('applicantView');

    Route::get('/sendmessages/{applicantId}', [App\Http\Controllers\BankBranchController::class, 'messagesSend'])->name('messagesSend');

    Route::post('/messages/store/{applicantId}', [App\Http\Controllers\BankBranchController::class, 'messagesStore'])->name('messagesStore');
    // Route::delete('delete-branch/{id}',[App\Http\Controllers\BankBranchController::class, 'destroy'])->name('delete-branch');  

});

});

Route::middleware('auth:departments')->prefix('department')->namespace('Admin')->group(function () {
    Route::middleware('check_user_role:4')->group(function () {
         Route::get('/', [App\Http\Controllers\DepartmentController::class, 'departmentDashboard'])->name('department_dashboard');

        Route::get('depts', [App\Http\Controllers\DepartmentController::class, 'show'])->name('depts'); 

        Route::get('/edit_dept/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('edit_dept');
        
        Route::patch('/update_dept/{id}',[App\Http\Controllers\DepartmentController::class, 'update'])->name('update_dept'); 

        Route::get('/add_csr_request', [App\Http\Controllers\DepartmentController::class, 'addCsrRequest'])->name('addCsrRequest'); 

        Route::post('/store_csr_request', [App\Http\Controllers\DepartmentController::class, 'storeCsrRequest'])->name('store_csr_request');
    
        Route::get('csr_requests', [App\Http\Controllers\DepartmentController::class, 'viewCsrRequest'])->name('csr_requests'); 
    
        Route::get('/edit_csr_request/{id}', [App\Http\Controllers\DepartmentController::class, 'editCsrRequest'])->name('edit_csr_request');
        
        Route::patch('/update_csr_request/{id}',[App\Http\Controllers\DepartmentController::class, 'updateCsrRequest'])->name('update_csr_request'); 
    
        Route::delete('delete_csr_request/{id}',[App\Http\Controllers\DepartmentController::class, 'destroy'])->name('delete_csr_request');
    });
});

Route::middleware('auth:applicants')->prefix('applicant')->namespace('Admin')->group(function () {
    Route::middleware('check_user_role:5')->group(function () {
        
       Route::get('/', [App\Http\Controllers\frontend\IndexController::class, 'applicantDashboard'])->name('applicants_dashboard');

        Route::get('filter-apply-loan', [App\Http\Controllers\frontend\IndexController::class, 'filterapplyloan'])->name('filterapplyloans');

        Route::get('/sendmessages/{applicantId}', [App\Http\Controllers\frontend\IndexController::class, 'messagesSend'])->name('send_message');

        Route::post('/messages/store/{applicantId}', [App\Http\Controllers\frontend\IndexController::class, 'messagesStore'])->name('store_message');
    });
});


Route::group(['namespace' => 'admin','prefix'=>'cms-admin', 'middleware' => ['auth', 'verified']], function() {
    Route::middleware('check_user_role:1')->group(function () {

    Route::get('/', [App\Http\Controllers\admin\BankNodalController::class, 'adminDashboard'])->name('dashboard');

    Route::get('filterapplyloanapplications/', [App\Http\Controllers\admin\BankNodalController::class, 'filterapplyloan'])->name('filterapplyloanapplications');

    Route::get('/applicant/{applicant}/view', [App\Http\Controllers\admin\BankNodalController::class, 'applicantView'])->name('applicant_view');

    Route::get('/sendmessages/{applicantId}', [App\Http\Controllers\admin\BankNodalController::class, 'messagesSend'])->name('message_send');

    Route::post('/messages/store/{applicantId}', [App\Http\Controllers\admin\BankNodalController::class, 'messagesStore'])->name('message_store');

    Route::get('/add-bank-nodal', [App\Http\Controllers\admin\BankNodalController::class, 'index'])->name('add-bank-nodal'); 

    Route::post('/store-bank-nodal', [App\Http\Controllers\admin\BankNodalController::class, 'create'])->name('store-bank-nodal');

    Route::get('bank-nodals', [App\Http\Controllers\admin\BankNodalController::class, 'show'])->name('bank-nodals'); 

    Route::get('/edit-bank-nodal/{id}', [App\Http\Controllers\admin\BankNodalController::class, 'edit'])->name('edit-bank-nodal');
    
    Route::patch('/update-bank-nodal/{id}',[App\Http\Controllers\admin\BankNodalController::class, 'update'])->name('update-bank-nodal'); 

    Route::delete('delete-bank-nodal/{id}',[App\Http\Controllers\admin\BankNodalController::class, 'destroy'])->name('delete-bank-nodal');  

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

    Route::get('/add_slider', [App\Http\Controllers\admin\SliderController::class, 'index'])->name('add_slider'); 

    Route::post('/store_slider', [App\Http\Controllers\admin\SliderController::class, 'create'])->name('store_slider');

    Route::get('sliders', [App\Http\Controllers\admin\SliderController::class, 'show'])->name('sliders'); 

    Route::get('/edit_slider/{id}', [App\Http\Controllers\admin\SliderController::class, 'edit'])->name('edit_slider');
    
    Route::patch('/update_slider/{id}',[App\Http\Controllers\admin\SliderController::class, 'update'])->name('update_slider'); 

    Route::delete('delete_slider/{id}',[App\Http\Controllers\admin\SliderController::class, 'destroy'])->name('delete_slider');

    Route::get('/add_csr_category', [App\Http\Controllers\admin\CSRCategoryController::class, 'index'])->name('add_csr_category'); 

    Route::post('/store_csr_category', [App\Http\Controllers\admin\CSRCategoryController::class, 'create'])->name('store_csr_category');

    Route::get('csr_categories', [App\Http\Controllers\admin\CSRCategoryController::class, 'show'])->name('csr_categories'); 

    Route::get('/edit_csr_category/{id}', [App\Http\Controllers\admin\CSRCategoryController::class, 'edit'])->name('edit_csr_category');
    
    Route::patch('/update_csr_category/{id}',[App\Http\Controllers\admin\CSRCategoryController::class, 'update'])->name('update_csr_category'); 

    Route::delete('delete_csr_category/{id}',[App\Http\Controllers\admin\CSRCategoryController::class, 'destroy'])->name('delete_csr_category');

    // Route::get('/add_csr_request', [App\Http\Controllers\admin\CSR_RequestController::class, 'index'])->name('add_csr_request'); 

    // Route::post('/store_csr_request', [App\Http\Controllers\admin\CSR_RequestController::class, 'create'])->name('store_csr_request');

    // Route::get('csr_requests', [App\Http\Controllers\admin\CSR_RequestController::class, 'show'])->name('csr_requests'); 

    // Route::get('/edit_csr_request/{id}', [App\Http\Controllers\admin\CSR_RequestController::class, 'edit'])->name('edit_csr_request');
    
    // Route::patch('/update_csr_request/{id}',[App\Http\Controllers\admin\CSR_RequestController::class, 'update'])->name('update_csr_request'); 

    // Route::delete('delete_csr_request/{id}',[App\Http\Controllers\admin\CSR_RequestController::class, 'destroy'])->name('delete_csr_request');

    Route::get('/add_loan_category', [App\Http\Controllers\admin\LoanCategoryController::class, 'index'])->name('add_loan_category'); 

    Route::post('/store_loan_category', [App\Http\Controllers\admin\LoanCategoryController::class, 'create'])->name('store_loan_category');

    Route::get('loan_categories', [App\Http\Controllers\admin\LoanCategoryController::class, 'show'])->name('loan_categories'); 

    Route::get('/edit_loan_category/{id}', [App\Http\Controllers\admin\LoanCategoryController::class, 'edit'])->name('edit_loan_category');
    
    Route::patch('/update_loan_category/{id}',[App\Http\Controllers\admin\LoanCategoryController::class, 'update'])->name('update_loan_category'); 

    Route::delete('delete_loan_category/{id}',[App\Http\Controllers\admin\LoanCategoryController::class, 'destroy'])->name('delete_loan_category');
    
    });
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
