<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\GovtSchemes; 
use App\Models\CSRCategory;
use App\Models\CSR_Request;
use App\Models\ApplyLoans;
use App\Models\Applys;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function index()
    {
        $slider = Slider::where('status',1)->get();
        $category = CSRCategory::where('is_active',1)->get();
        $perPage = 10;
        $govt_schemes = GovtSchemes::where('is_active', 1)
                ->orderBy('sort_col', 'asc')
                ->paginate($perPage);
        // $govt_schemes = GovtSchemes::where('is_active',1)->orderBy('sort_col', 'asc')->get();
        return view('welcome',compact('slider','govt_schemes','category'));
    }

    public function showCsrRequests($categoryId)
{
    $category = CSRCategory::find($categoryId);
    $csrRequests = $category->csrRequests;

    return view('frontend.csr-requests', compact('csrRequests', 'category'));
}

// public function showRequestsByCategory($categoryId)
// {
//     $csrRequests = CSRRequest::whereHas('csrCategory', function ($query) use ($categoryId) {
//         $query->where('id', $categoryId);
//     })->get();

//     $category = CSRCategory::find($categoryId);

//     return view('frontend.csr-requests', compact('csrRequests', 'category'));
// }
    

    public function applyLoan()
    {
        $banks = DB::table('bank_nodals')->where('user_type_id','2')->where('is_active','1')->get();
        $loan_category = DB::table('loan_categories')->where('is_active','1')->get();
        return view('frontend.apply-loan',compact('banks','loan_category'));
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

//     public function saveApplyLoan(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'name' => 'required|regex:/^[a-zA-Z\s]+$/',
//         'phoneNumber' => 'required|digits:10',
//         'email' => 'nullable|email|regex:/@.+\.\w{2,}$/',
//         'address' => 'required',
//         'city' => 'required',
//         'state' => 'required',
//         'pincode' => 'required',
//         'loan_category' => 'required',
//         'loanDescription' => 'required',
//         'bankName' => 'required',
//         'bankBranch' => 'required',
//         'captcha' => 'required|captcha'
//     ]);
    
    
//     if ($validator->fails()) {
//         return response()->json([
//             'message' => $validator->errors()->first(),
//         ]);
//     }

//     $phoneNumber = $request->input('phoneNumber');
//     $otp = '1234'; // You can use a more secure method to generate OTPs
//     $status = 'Verified';
//     $user_type_id = 5;
//     $mailPassword = Str::random(8);
//     $savePassword = Hash::make($mailPassword);

//     $user = User::updateOrCreate(
//         ['email' => $request->input('email')],
//         [
//             'name' => $request->input('name'),
//             'phoneNumber' => $phoneNumber,
//             'password' => $savePassword,
//             'otp' => $otp,
//             'user_type_id' => $user_type_id,
//         ]);

//     $request->session()->put('applied_loan_password', $mailPassword);

//     $applyLoanData = $request->except(['_token', 'otp', 'captcha']);
//     $applyLoanData['status'] = $status;
//     $applyLoanData['user_type_id'] = $user_type_id;
//     $applyLoanData['password'] = $savePassword;
//     $applyLoanData['captcha'] = $request->input('captcha');
//     $applyLoanData['created_at'] = now();
//     $applyLoanData['updated_at'] = now();

//     DB::table('temp_apply_loans')->insert($applyLoanData);

//     return response()->json([
//         'message' => 'Loan applied successfully. Please verify your OTP.',
//         'redirect_url' => route('applyLoanOtp', ['phoneNumber' => $phoneNumber]),
//     ]);
// }

// public function saveApplyLoan(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'name' => 'required|regex:/^[a-zA-Z\s]+$/',
//         'phoneNumber' => 'required|digits:10',
//         'email' => 'nullable|email|regex:/@.+\.\w{2,}$/',
//         'address' => 'required',
//         'city' => 'required',
//         'state' => 'required',
//         'pincode' => 'required',
//         'loan_category' => 'required',
//         'loanDescription' => 'required',
//         'bankName' => 'required',
//         'bankBranch' => 'required',
//         'captcha' => 'required|captcha'
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'message' => $validator->errors()->first(),
//         ]);
//     }

//     $phoneNumber = $request->input('phoneNumber');
//     $otp = rand(100000, 999999); // Generate a secure OTP
//     $status = 'Applied';
//     $user_type_id = 5;
//     $mailPassword = Str::random(8);
//     $savePassword = Hash::make($mailPassword);

//     $user = User::updateOrCreate(
//         ['email' => $request->input('email')],
//         [
//             'name' => $request->input('name'),
//             'phoneNumber' => $phoneNumber,
//             'password' => $savePassword,
//             'otp' => $otp,
//             'user_type_id' => $user_type_id,
//         ]
//     );

//     $request->session()->put('applied_loan_password', $mailPassword);

//     $applyLoanData = $request->except(['_token', 'otp', 'captcha']);
//     $applyLoanData['status'] = $status;
//     $applyLoanData['user_type_id'] = $user_type_id;
//     $applyLoanData['password'] = $savePassword;
//     $applyLoanData['captcha'] = $request->input('captcha');
//     $applyLoanData['created_at'] = now();
//     $applyLoanData['updated_at'] = now();

//     DB::table('temp_apply_loans')->insert($applyLoanData);

//     // Send voice OTP using cURL
//     $target_url = "http://voice.thesmsworld.com/API/singleClipDialer.php?auth=D!2596hvz0nGNnUw";
//     $postData = array(
//         'clipid' => 12222,
//         'msisdn' => $phoneNumber,
//         'type' => 3,
//         'otp' => $otp
//     );

//     $ch = curl_init($target_url);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Change to 1 to verify cert
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $json = curl_exec($ch);
//     $curlError = curl_error($ch); // Capture any cURL errors
//     curl_close($ch);

//     // Log the cURL response and error
//     Log::info('Voice OTP Response: ' . $json);
//     if ($curlError) {
//         Log::error('cURL Error: ' . $curlError);
//     }

//     // Check if the OTP response is successful
//     $otpResponse = json_decode($json, true);
//     if ($otpResponse['status'] === 'failure') {
//         return response()->json([
//             'message' => 'Failed to send OTP. Please try again.',
//             'error' => $otpResponse['desc']
//         ]);
//     }

//     return response()->json([
//         'message' => 'Loan applied successfully. Please verify your OTP.',
//         'redirect_url' => route('applyLoanOtp', ['phoneNumber' => $phoneNumber]),
//     ]);
// }


public function saveApplyLoan(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|regex:/^[a-zA-Z\s]+$/',
        'phoneNumber' => 'required|digits:10',
        'email' => 'nullable|email|regex:/@.+\.\w{2,}$/',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'pincode' => 'required',
        'loan_category' => 'required',
        'loanDescription' => 'required',
        'bankName' => 'required',
        'bankBranch' => 'required',
        'captcha' => 'required|captcha'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors()->first(),
        ]);
    }

    $phoneNumber = $request->input('phoneNumber');
    $otp = rand(100000, 999999); // Generate a secure OTP
    $status = 'Applied';
    $user_type_id = 5;
    $mailPassword = Str::random(8);
    $savePassword = Hash::make($mailPassword);

    $user = User::updateOrCreate(
        ['email' => $request->input('email')],
        [
            'name' => $request->input('name'),
            'phoneNumber' => $phoneNumber,
            'password' => $savePassword,
            'otp' => $otp,
            'user_type_id' => $user_type_id,
        ]
    );

    $request->session()->put('applied_loan_password', $mailPassword);

    $applyLoanData = $request->except(['_token', 'otp', 'captcha']);
    
    $applyLoanData['status'] = $status;
    $applyLoanData['user_type_id'] = $user_type_id;
    $applyLoanData['password'] = $savePassword;
    $applyLoanData['captcha'] = $request->input('captcha');
    $applyLoanData['created_at'] = now();
    $applyLoanData['updated_at'] = now();

    DB::table('temp_apply_loans')->insert($applyLoanData);

    // Send voice OTP using cURL
    $target_url = "http://voice.thesmsworld.com/API/singleClipDialer.php?auth=D!25961pVtFkUOfu";
    $postData = array(
        'clipid' => 12222,
        'msisdn' => $phoneNumber,
        'type' => 3,
        'otp' => $otp,
        'retry' => 1,
        'repeat' => 1,
    );

    $ch = curl_init($target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Change to 1 to verify cert
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    $curlError = curl_error($ch); // Capture any cURL errors
    curl_close($ch);

    // Log the cURL response and error
    Log::info('Voice OTP Response: ' . $json);
    if ($curlError) {
        Log::error('cURL Error: ' . $curlError);
    }
    
   // dd($json);

    return response()->json([
        'message' => 'Loan applied successfully. Please verify your OTP.',
        'redirect_url' => route('applyLoanOtp', ['phoneNumber' => $phoneNumber]),
        'otp_response' => $json // Optional: include the response for debugging
    ]);
    
    
}

// public function addvendor(Request $request)
// {
//     // Validate the incoming request
//     $validator = Validator::make($request->all(), [
//         'user_id' => 'required|exists:users,id',
//         'user_type' => 'required',
//         // Add other vendor-specific validation rules here
//     ]);

//     if ($validator->fails()) {
//         return response()->json(['errors' => $validator->errors()], 422);
//     }

//     // Retrieve the user by the provided user_id
//     $user_id = $request->user_id;
//     $user = User::find($user_id);

//     if ($user) {
//         // Update the user_type
//         $user->user_type = $request->user_type;
//         $user->update();

//         // Insert data into the vendors table
//         $vendor = new Vendor();
//         $vendor->user_id = $user->id;
//         $vendor->vendor_name = $user->name; // Example: setting vendor name from user name
//         // Add other vendor attributes from the user data
//         $vendor->email = $user->email;
//         $vendor->phone = $user->phone; // Assuming you have a phone column in the users table
//         // Set other vendor-specific attributes if necessary
//         $vendor->save();

//         return response()->json([
//             'user' => $user,
//             'vendor' => $vendor
//         ], 201);
//     } else {
//         return response()->json(['error' => 'User not found'], 404);
//     }
// }

public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function verifyOtp(Request $request, $phoneNumber)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
        ], [
            'otp.required' => 'Please enter the OTP.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        $otp = $request->input('otp');
    
        // Retrieve the latest user record with the given phone number
        $user = User::where('phoneNumber', $phoneNumber)->latest()->first();
    
        if (!$user) {
            return back()->with('error', 'User not found');
        }
    
        // Check if the provided OTP matches the OTP stored in the user record
        if ($otp === $user->otp) {
            // OTP is correct, proceed with loan application
    
            // Update the OTP field and other fields as needed
            DB::table('temp_apply_loans')->where('phoneNumber', $phoneNumber)->update([
                'otp' => $otp,
                // Add other fields here as needed
            ]);
    
            // Retrieve the latest updated record from the apply_loan_temp table with the given phone number
            $updatedRecord = DB::table('temp_apply_loans')->where('phoneNumber', $phoneNumber)->latest('updated_at')->first();
    
            // Convert the $updatedRecord object to an array
            $updatedRecordArray = (array) $updatedRecord;
    
            if (isset($updatedRecordArray['email'])) {
                // Check if the email already exists in the apply_loans table
                $applicantId = ApplyLoans::where('email', $updatedRecordArray['email'])->value('id');
    
                if ($applicantId) {
                    // Generate a new password
                    $password = Str::random(8);
    
                    // Set the password value in the apply_loans table
                    ApplyLoans::where('email', $updatedRecordArray['email'])->update([
                        'password' => Hash::make($password),
                    ]);
    
                    // Set the applicant_id value in the $updatedRecordArray
                    $updatedRecordArray['applicant_id'] = $applicantId;
    
                    // Remove the id field from the array
                    unset($updatedRecordArray['id']);
    
                    // Create a new record in the applys table using the applicant_id
                    $applys = Applys::insertGetId($updatedRecordArray);
    
                    // Send the email
                    $data = array(
                        'name' => $updatedRecordArray['name'],
                        'email' => $updatedRecordArray['email'],
                        'password' => $password,
                        'phoneNumber' => $updatedRecordArray['phoneNumber'],
                        // Add other data as needed
                    );
    
                    Mail::send('admin.applicant_mail', $data, function ($message) use ($data) {
                        $message->to($data['email'], $data['name']);
                        $message->subject('Login with this credentials');
                    });
    
                    // Remove the password from the session
                    $request->session()->forget('applied_loan_password');
    
                    // Store the user's email in the session
                    session()->flash('email', $user->email);
    
                    // Redirect to a success page or confirmation message
                    return response()->json([
                        'message' => 'Loan applied successfully. Please verify your OTP.',
                        'email' => $user->email,
                        'password' => $password,
                        'redirect_url' => route('guest.applicants_login', ['email' => $user->email]), // Corrected to use $user->email
                    ]);
                } else {
                    // Email does not exist, create a new record in the apply_loans table
                    $applyLoanData = $updatedRecordArray;
                    unset($applyLoanData['id']); // Remove the id key from the array to allow Laravel to auto-increment the value
                    $applyLoanData['created_at'] = $updatedRecordArray['created_at'];
                    $applyLoanData['updated_at'] = $updatedRecordArray['updated_at'];
                    $applicantId = ApplyLoans::insertGetId($applyLoanData);
    
                    // Set the applicant_id value in the $updatedRecordArray
                    $updatedRecordArray['applicant_id'] = $applicantId;
    
                    // Create a new record in the applys table using the applicant_id
                    unset($updatedRecordArray['id']);
                    $apply = Applys::insertGetId($updatedRecordArray);
                }
    
                // Retrieve the password from the session
                $password = $request->session()->get('applied_loan_password');
    
                // Send mail after saving data in apply_loans table
                $data = array(
                    'name' => $updatedRecordArray['name'],
                    'email' => $updatedRecordArray['email'],
                    'password' => $request->session()->get('applied_loan_password'),
                    'phoneNumber' => $updatedRecordArray['phoneNumber'],
                    // Add other data as needed
                );
    
                Mail::send('admin.applicant_mail', $data, function ($message) use ($data) {
                    $message->to($data['email'], $data['name']);
                    $message->subject('Login with this credentials');
                });
    
                // Remove the password from the session
                $request->session()->forget('applied_loan_password');
    
                // Store the user's email in the session
                session()->flash('email', $user->email);
    
                // Redirect to a success page or confirmation message
                return response()->json([
                    'message' => 'Loan applied successfully. Please verify your OTP.',
                    'email' => $user->email,
                    'password' => $password,
                    'redirect_url' => route('guest.applicants_login', ['email' => $user->email]), // Corrected to use $user->email
                ]);
            } else {
                $applicantId = ApplyLoans::where('phoneNumber', $updatedRecordArray['phoneNumber'])->value('id');
    
                if ($applicantId) {
                    // Set the applicant_id value in the $updatedRecordArray
                    $updatedRecordArray['applicant_id'] = $applicantId;
    
                    // Remove the id field from the array
                    unset($updatedRecordArray['id']);
    
                    // Create a new record in the applys table using the applicant_id
                    $applys = Applys::insertGetId($updatedRecordArray);
    
                    // Email is null, redirect to apply-loan route
    $message = 'Loan applied successfully.';
    $url = route('apply-loan') . '?message=' . urlencode($message);
    return response()->json([
        'message' => $message,
        'redirect_url' => $url,
    ]);
                } else {
                    // Email does not exist, create a new record in the apply_loans table
                    $applyLoanData = $updatedRecordArray;
                    unset($applyLoanData['id']); // Remove the id key from the array to allow Laravel to auto-increment the value
                    $applyLoanData['created_at'] = $updatedRecordArray['created_at'];
                    $applyLoanData['updated_at'] = $updatedRecordArray['updated_at'];
                    $applicantId = ApplyLoans::insertGetId($applyLoanData);
    
                    // Set the applicant_id value in the $updatedRecordArray
                    $updatedRecordArray['applicant_id'] = $applicantId;
    
                    // Create a new record in the applys table using the applicant_id
                    unset($updatedRecordArray['id']);
                    $apply = Applys::insertGetId($updatedRecordArray);
    
                   // Email is null, redirect to apply-loan route
    $message = 'Loan applied successfully.';
    $url = route('apply-loan') . '?message=' . urlencode($message);
    return response()->json([
        'message' => $message,
        'redirect_url' => $url,
    ]);
                }
            }
        } else {// Incorrect OTP, return a JSON response with the error message
            return response()->json(['error' => 'Invalid OTP. Please try again.'], 422);
        }
    }

public function applicantDashboard()
{
    $applicant_email = Auth::guard('applicants')->user()->email;

   $applys = Applys::where('email', $applicant_email)->get();
   //dd($applys);

    
   //dd($applicant_email);

    // Count records with the applicant's email
    $all = Applys::where('email', $applicant_email)
        ->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
        ->count();

$applied = Applys::where('email', $applicant_email)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
    $query->where('status', '!=', 'Deleted');
}])
    ->where('status', 'Applied')
->count();

    $inProcess = Applys::where('email', $applicant_email)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'In Process')
    ->count();

    $sendBackToUser = Applys::where('email', $applicant_email)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Send back to user')
    ->count();

    $accepted = Applys::where('email', $applicant_email)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Approved')
    ->count();

    $rejected = Applys::where('email', $applicant_email)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Rejected')
    ->count();


    $statuses = [
        'Applied',
        'In Process',
        'Send back to user',
        'Approved',
        'Rejected'
    ];

        return view('applicants.dashboard',compact('all', 'applied', 'inProcess', 'sendBackToUser', 'accepted', 'rejected', 'statuses'));
    }



public function filterapplyloan(Request $request)
{
    $applicant_email = Auth::guard('applicants')->user()->email;
    $status = $request->query('status');
    
    if ($status) {
        $applyloan = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
            ->where('email', $applicant_email)
            ->where('status', $status)
            ->get();
    } else {
        $applyloan = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
            ->where('email', $applicant_email)
            ->get();
    }

    // Retrieve the applicant details from the apply_loans table
    $applicants = Applys::with(['loanCategory', 'bankNodal', 'bankBranches'])
                          ->where('email', $applicant_email)
                          ->get();

    // Pass the $applyLoans variable to the view
    return view('applicants.filterapplyloan', compact('applicants'));
}


public function messagesSend($applicantId)
{
    //dd($applicantId);
    $messages = Message::where('applicant_id', $applicantId)
    ->with('user')
    ->get();
   // dd($messages);
   
   // Fetch the status of the applicant
    $applicantStatus = Applys::where('id', $applicantId)->value('status', 'applicantStatus');

    return view('applicants.chat', compact('messages', 'applicantId', 'applicantStatus'));
}

public function messagesStore(Request $request, $applicantId)
{
    $validatedData = $request->validate([
        'text' => 'required_without:file|max:255',
        'file' => 'required_without:text|array|max:5', // Limit the number of files to 5
        'file.*' => 'file',
    ]);

     // Fetch the applicant data
     $applicant = Applys::find($applicantId);

     // Fetch the user data from the bank_branches table
     $user = Applys::find(auth('applicants')->user()->id);

    $message = Message::create([
        'applicant_id' => $applicantId,
        'user_id' => auth('applicants')->user()->id,
        'text' => $request->input('text'),
        'status' => $applicant->status,
        'user_type_id' => $user->user_type_id, // Add this line to store the user_type_id from the bank_branches table
    ]);

    if ($request->has('file')) {
        $filenames = [];
        foreach ($request->file('file') as $file) {
            $extension = $file->getClientOriginalName(); // Corrected variable name
            $filename = time() . '.' . $extension;
            $file->move('storage/', $filename);
            $filenames[] = $filename;
        }
        $message->file = json_encode($filenames);
    }

    $message->save();

    session()->flash('message', 'Message created and job dispatched.');

    return redirect()->back();
}


public function applyLoanOtp($phoneNumber)
{
    return view('frontend.apply-loan-otp', ['phoneNumber' => $phoneNumber]);
}

public function trackLoanOtp($phoneNumber)
{
    return view('frontend.track-loan-otp', compact('phoneNumber'));
}

    public function trackLoanStatus()
    {
        return view('frontend.track-loan-status');
    }

    public function show_loan_status(Request $request)
    {
        //dd("kk");
        $validator = Validator::make($request->all(), [
            'phoneNumber' => 'required',
            'captcha' => 'required|captcha'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Store the phone number in a variable
        $phoneNumber = $request->input('phoneNumber');
        $captcha = $request->input('captcha');
    
        // Generate OTP (for simplicity, you can use a fixed OTP '1234')
        $otp = rand(100000, 999999); // Generate a secure OTP
        // Store the validated data, OTP, and password in the session
        $trackLoanData = $request->except('_token');
        $trackLoanData['otp'] = $otp;
        $request->session()->put('trackLoanData', $trackLoanData);
    
        DB::table('track_loan_status')->insert([
            'phoneNumber' => $phoneNumber,
            'otp' => $otp,
            'captcha' => $captcha,
        ]);

         // Send voice OTP using cURL
    $target_url = "http://voice.thesmsworld.com/API/singleClipDialer.php?auth=D!25961pVtFkUOfu";
    $postData = array(
        'clipid' => 12222,
        'msisdn' => $phoneNumber,
        'type' => 3,
        'otp' => $otp,
        'retry' => 1,
        'repeat' => 1,
    );

    $ch = curl_init($target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Change to 1 to verify cert
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    $curlError = curl_error($ch); // Capture any cURL errors
    curl_close($ch);

    // Log the cURL response and error
    Log::info('Voice OTP Response: ' . $json);
    if ($curlError) {
        Log::error('cURL Error: ' . $curlError);
    }
    
   // dd($json);

    // return response()->json([
    //    // 'message' => 'Loan applied successfully. Please verify your OTP.',
    //     'redirect_url' => route('trackLoanOtp', ['phoneNumber' => $phoneNumber]),
    //     'otp_response' => $json // Optional: include the response for debugging
    // ]);
    
    
        // If no validation errors, redirect to applyLoanOtp route
        return redirect()->route('trackLoanOtp', compact('phoneNumber'));

    }

    public function verify_track_loan_otp(Request $request)
{
    $validator = Validator::make($request->all(), [
        'otp' => 'required|numeric',
    ]);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $otp = $request->input('otp');
    $phoneNumber = $request->session()->get('trackLoanData')['phoneNumber'];

    // Retrieve the user record with the given phone number
    $user = DB::table('track_loan_status')
    ->where('phoneNumber', $phoneNumber)
    ->orderBy('id', 'desc')
    ->first();

    //dd($user);
    if (!$user) {
        return back()->with('error', 'User not found');
    }

    // Check if the provided OTP matches the OTP stored in the user record
    if ($otp == $user->otp) {
        // OTP is correct, proceed with loan application
        // Retrieve the loan application record with the given phone number
        $applyLoans = DB::table('applys')
        ->select('applys.*', 'bank_nodals.bank_name as bank_name', 'bank_branches.branch_address as branch_address')
        ->join('bank_nodals', 'applys.bankName', '=', 'bank_nodals.id')
        ->join('bank_branches', 'applys.bankBranch', '=', 'bank_branches.id')
        ->where('applys.phoneNumber', $phoneNumber)
        ->get();

        // Pass the loan application record to the view
        return view('frontend.loan-status', compact('applyLoans'));

    } else {
        // Incorrect OTP, redirect back with an error message
        return back()->with('error', 'Invalid OTP. Please try again.');
    }
}

public function updateOtp(Request $request)
{
    $phoneNumber = $request->phoneNumber;
    $otp = $request->otp;

    // Update the user's OTP field in the database
    $user = User::where('phoneNumber', $phoneNumber)->first();
    $user->otp = $otp;
    $user->save();

    // Return a JSON response indicating success
    return response()->json(['success' => true]);
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
