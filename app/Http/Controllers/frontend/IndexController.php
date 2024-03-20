<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
class IndexController extends Controller
{
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
    public function index()
    {
        $slider = Slider::where('status',1)->get();
        return view('welcome',compact('slider'));
    }

    public function applyLoan()
    {
        $banks = DB::table('users')->where('user_type_id','2')->get();
        return view('frontend.apply-loan',compact('banks'));
    }
    
    public function getBankBranchesByBankName(Request $request){
        
        $bankBranches = DB::table('users')->where('bank_id',$request->bank_id)->get();
        $options='<option value="">Choose</option>';
        if($bankBranches){
            foreach($bankBranches as $bankBranche){
                $options.='<option value="'.$bankBranche->id.'">'.$bankBranche->branch_address.'</option>';
            }
        } 
        return $options;
         
    }
    
    public function saveApplyLoan(Request $request){
        
            // echo '<pre>'; print_r($request->all()); die; 

        $request->validate([
            'name'              => 'required',
            'phoneNumber'       => 'required',
            'address'           => 'required', 
            'loanDescription'   => 'required', 
            'bankName'          => 'required',
            'bankBranch'       => 'required',
        ]); 
        
        
        $data['name']           = $request->name;
        $data['phoneNumber']    = $request->phoneNumber;
        $data['email']          = $request->email;
        $data['address']        = $request->address;
        $data['landmark']       = $request->landmark;
        $data['state']          = $request->state;
        $data['city']           = $request->city;
        $data['pincode']        = $request->pincode;
        $data['loanDescription']= $request->loanDescription;
        $data['bankName']      = $request->bankName;
        $data['bankBranch']    = $request->bankBranch;
        
        // echo '<pre>';print_r($data); die;
        $save = DB::table('apply_loan')->insert($data);
        
        return redirect()->route('apply-loan')->with('success', 'Loan Applied Successfully');
    }
    
    public function applyLoanOtp()
    {
        return view('frontend.apply-loan-otp');
    }

    public function trackLoanStatus()
    {
        return view('frontend.track-loan-status');
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
