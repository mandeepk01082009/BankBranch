<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankBranches;   
use App\Models\BankNodal; 
use App\Models\ApplyLoans; 
use App\Models\Applys; 
use App\Models\Message;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

class BankBranchController extends Controller
{
    public function index()
    {
        $bank = BankNodal::where('is_active',1)->get();
        return view('bank_branches.BankBranches.form',compact('bank'));              
    }

    
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'bank_id' => 'required|string|max:255',
        'email' => 'required|email',  
        'mobile' => 'required',  
        'branch_address' => 'required',
        'concerned_person' => 'required',
        'block' => 'required',
 ]);

 // Generate a random password
 $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class
 
 $bank_branch = BankBranches::create([
    'sort_col' => $data['sort_col'],
    'bank_id' => $data['bank_id'], 
    'email' => $data['email'],
    'mobile' => $data['mobile'],
    'password' => Hash::make($password), // Use the generated password directly
    'is_active' => 1, // Set the default value for the 'active' field 
    'user_type_id' => 3, 
    'branch_address' => $data['branch_address'],
    'concerned_person' => $data['concerned_person'],
    'block' => $data['block'],
 ]);
      
    // Adjust the data array to include the password for the email
    $data['password'] = $password; // Add this line to include the password in the data array
    
    // Now, you can safely pass $data to the view or mail class, and it will include the 'password'

    Mail::send('admin.bank_branch_mail', $data, function($message) use ($data){
        $message->to($data['email'], $data['concerned_person']);  
        $message->subject('Login with this credentials');   
    });

 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/bank-branches/branches');   

}

public function show()
{  
    $bankBranchId = auth('bank_branches')->user()->id;

    $bankBranch = DB::table('bank_branches')
        ->join('bank_nodals', 'bank_branches.bank_id', '=', 'bank_nodals.id')
        ->where('bank_branches.id', $bankBranchId)
        ->select('bank_branches.*', 'bank_nodals.bank_name as bank_name')
        ->first();

    return view('bank_branches.BankBranches.index')->with('bank_branch', $bankBranch);
}


    public function edit(string $id)
    {
        $bank = BankNodal::where('is_active',1)->get();
        $bank_branch = BankBranches::find($id);                 
        // show the edit form and pass the   
        return view('bank_branches.BankBranches.edit',compact('bank_branch','bank'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $bank_branch = BankBranches::find($id);  
        
        // $bank_branch->sort_col = $request->input('sort_col');

        // $bank_branch->bank_id = $request->input('bank_id');

        $bank_branch->concerned_person = $request->input('concerned_person');

        $bank_branch->branch_address = $request->input('branch_address');

        $bank_branch->mobile = $request->input('mobile');

        $bank_branch->email = $request->input('email');

        $bank_branch->password = Hash::make($request->input('password'));

        $bank_branch->block = $request->input('block');

        $bank_branch->is_active = 1;

        $bank_branch->user_type_id = 3;
    
    $bank_branch->update();                 

    return redirect('/bank-branches/branches');        
    }

    public function destroy(string $id)             
    {
        $dcosContact = DB::table('users')->where('id', $id)->update(['is_active' => 0]);
    
        return redirect('/bank-branches/branches');
    }

   public function bankBranchDashboard()
    {
        $bank_branch_id = auth('bank_branches')->user()->id;
        // Count the number of apply_loan records where status is Pending and bankBranch matches the bank_branch_id
        $all = Applys::where('bankBranch', $bank_branch_id)
        ->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
        ->count();

$verified = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
    $query->where('status', '!=', 'Deleted');
}])
    ->where('status', 'Verified')
->count();

    $inProcess = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'In Process')
    ->count();

    $sendBackToUser = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Send back to user')
    ->count();

    $accepted = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Approved')
    ->count();

    $rejected = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Rejected')
    ->count();


    $statuses = [
        'Verified',
        'In Process',
        'Send back to user',
        'Approved',
        'Rejected'
    ];

        return view('bank_branches.dashboard',compact('all', 'verified', 'inProcess', 'sendBackToUser', 'accepted', 'rejected', 'statuses'));
    }

    public function filterapplyloan(Request $request)
{
    $bank_branch_id = auth('bank_branches')->user()->id;
    $status = $request->query('status');
    $search = $request->query('search');
    $lastChatDate = $request->query('created_at');
    $applyDate = $request->query('apply_date');

    try {
        $applyloan = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
        ->where('bankBranch', $bank_branch_id)
        ->where(function($query) use ($status, $search, $lastChatDate, $applyDate ) {
            $query->where(function($query) use ($status, $search, $lastChatDate, $applyDate) {
                if ($status) {
                    $query->where('applys.status', $status);
                }
        
                if ($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phoneNumber', 'like', "%{$search}%");
                    });
                }
        
                if ($lastChatDate) {
                    $query->whereHas('messages', function($query) use ($lastChatDate) {
                        $query->whereDate('created_at', '=', $lastChatDate);
                    });
                }

                if ($applyDate) {
                    $query->whereDate('applys.created_at', $applyDate);
                }
                
            });
        })
        
        ->orderBy('created_at', 'desc')
        ->simplePaginate(10);

        return view('bank_branches.filterapplyloan', compact('applyloan', 'search', 'status', 'lastChatDate'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred. Please try again.');
    }
}

public function view(int $applicantId)
{
    // Retrieve the applicant details from the apply_loans table
    $applicant = DB::table('applys')
        ->select('applys.*', 'bank_nodals.bank_name as bank_name', 'bank_branches.branch_address as branch_address', 'loan_categories.name as loan_category_name')
        ->leftJoin('bank_nodals', 'applys.bankName', '=', 'bank_nodals.id')
        ->leftJoin('bank_branches', 'applys.bankBranch', '=', 'bank_branches.id')
        ->leftJoin('loan_categories', 'applys.loan_category', '=', 'loan_categories.id')
        ->where('applys.id', $applicantId)
        ->first();
   // dd($applicant);

    // Check if the applicant exists
    if (!$applicant) {
        abort(404);
    }

    // Pass the applicant details to the view template
    return view('bank_branches.applicantview', ['applicant' => $applicant]);
}

    public function messagesSend($applicantId)
{
    $messages = Message::where('applicant_id', $applicantId)
    ->with('user')
    ->get();
    
     $applicantStatus = Applys::where('id', $applicantId)->value('status');

    return view('bank_branches.chat', compact('messages', 'applicantId', 'applicantStatus'));
}

public function messagesStore(Request $request, $applicantId)
{
    $validatedData = $request->validate([
        'text' => 'required_without:file|max:255',
        'file' => 'required_without:text|array|max:5', // Limit the number of files to 5
        'file.*' => 'file',
        'status' => 'required|in:In Process,Send back to user,Approved,Rejected',
    ]);

    // Fetch the applicant data
    $applicant = Applys::find($applicantId);

    // Fetch the user data from the bank_branches table
    $user = BankBranches::find(auth('bank_branches')->user()->id);

    $message = Message::create([
        'applicant_id' => $applicantId,
        'user_id' => auth('bank_branches')->user()->id,
        'text' => $request->input('text'),
        'status' => $request->status,
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

    // Update the status in the apply_loans table
    Applys::where('id', $applicantId)
        ->update(['status' => $request->status]);

    session()->flash('message', 'Message created and job dispatched.');

    return redirect()->back();
}


}
