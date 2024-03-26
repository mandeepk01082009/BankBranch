<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
use App\Models\GovtSchemes; 
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
        $perPage = 10;
        $govt_schemes = GovtSchemes::where('is_active', 1)
                ->orderBy('sort_col', 'asc')
                ->paginate($perPage);
        // $govt_schemes = GovtSchemes::where('is_active',1)->orderBy('sort_col', 'asc')->get();
        return view('welcome',compact('slider','govt_schemes'));
    }

    public function applyLoan()
    {
        $banks = DB::table('bank_nodals')->where('user_type_id','2')->get();
        return view('frontend.apply-loan',compact('banks'));
    }
    
    public function getBankBranchesByBankName(Request $request){
        
        $bankBranches = DB::table('bank_branches')->where('bank_id',$request->bank_id)->get();
        $options='<option value="">Choose</option>';
        if($bankBranches){
            foreach($bankBranches as $bankBranche){
                $options.='<option value="'.$bankBranche->id.'">'.$bankBranche->branch_address.'</option>';
            }
        } 
        return $options;
         
    }
    
    // public function saveApplyLoan(Request $request){
        
    //         // echo '<pre>'; print_r($request->all()); die; 

    //     $request->validate([
    //         'name'              => 'required',
    //         'phoneNumber'       => 'required',
    //         'address'           => 'required', 
    //         'loanDescription'   => 'required', 
    //         'bankName'          => 'required',
    //         'bankBranch'       => 'required',
    //     ]); 
        
        
        // $data['name']           = $request->name;
        // $data['phoneNumber']    = $request->phoneNumber;
        // $data['email']          = $request->email;
        // $data['address']        = $request->address;
        // $data['landmark']       = $request->landmark;
        // $data['state']          = $request->state;
        // $data['city']           = $request->city;
        // $data['pincode']        = $request->pincode;
        // $data['loanDescription']= $request->loanDescription;
        // $data['bankName']      = $request->bankName;
        // $data['bankBranch']    = $request->bankBranch;
        
    //     // echo '<pre>';print_r($data); die;
    //     $save = DB::table('apply_loan')->insert($data);
        
    //     return redirect()->route('apply-loan')->with('success', 'Loan Applied Successfully');
    // }

    public function saveApplyLoan(Request $request)
{
     // echo '<pre>'; print_r($request->all()); die; 
    $request->validate([
        'name' => 'required',
        'phoneNumber' => 'required',
        'address' => 'required', 
        'loanDescription' => 'required', 
        'bankName' => 'required',
        'bankBranch' => 'required',
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

    // Store the data in the session.
    $request->session()->put('loanApplication', $request->except(['_token']));

    // Redirect to OTP verification page.
    return redirect()->route('applyLoanOtp');
}

public function verifyOtp(Request $request)
{
    $otp = $request->input('otp');

    if ($otp == '1234') {
        // Retrieve data from session.
        $data = $request->session()->get('loanApplication');

        // Insert into the database.
        $save = DB::table('apply_loan')->insert($data);

        // Clear the session data for the loan application.
        $request->session()->forget('loanApplication');

        // Redirect to a confirmation page or route.
        return redirect()->route('apply-loan')->with('success', 'Loan Applied Successfully');
    } else {
        // Redirect back with an error message.
        return back()->with('error', 'Invalid OTP. Please try again.');
    }
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
