<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankNodal; 
use App\Models\User; 
use App\Models\ApplyLoans; 
use App\Models\Applys;
use App\Models\Message;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

class BankNodalController extends Controller
{
    public function index()
    {
        return view('admin.bank_nodals.form');              
    }

   
    public function create(Request $request)
    {
        $data = $request->validate([
            'sort_col' => 'required|integer',
            'bank_name' => 'required|string|max:255|unique:bank_nodals,bank_name',
            'dco_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
    
        // Generate a random password
        $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class
    
        // Create the bank nodal
        $bank_nodal = BankNodal::create([
            'sort_col' => $data['sort_col'],
            'bank_name' => $data['bank_name'],
            'dco_name' => $data['dco_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($password),
            'is_active' => 1,
            'user_type_id' => 2,
        ]);
    
        // Additionally, create a user in the users table
        $user = User::create([
            'email' => $data['email'],
            'password' => $bank_nodal->password,
            'user_type_id' => 2, // Set the default value directly
            'user_id' => $bank_nodal->id, // Assign the id of the BankNodal to bank_nodal_id
        ]);    
    
        // Adjust the data array to include the password for the email
        $data['password'] = $password; // Include the password in the data array
    
       // Send email with credentials
       Mail::send('admin.mail', $data, function($message) use ($data) {
        $message->to($data['email'], $data['dco_name']);
        $message->subject('Login with these credentials');
    });
    
        return redirect('/cms-admin/bank-nodals');
    }
        
 public function show()
    {  
        $bank_nodal = BankNodal::where('is_active',1)->where('user_type_id',2)->orderBy('sort_col', 'asc')->get();
        return view('admin.bank_nodals.index',compact('bank_nodal'));                  
    } 

    public function edit(string $id)
    {
        $bank_nodal = BankNodal::find($id);                 
        // show the edit form and pass the   
        return view('admin.bank_nodals.edit',compact('bank_nodal'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $bank_nodal = BankNodal::find($id);  
        
        $bank_nodal->sort_col = $request->input('sort_col');

        $bank_nodal->bank_name = $request->input('bank_name');

        $bank_nodal->dco_name = $request->input('dco_name');

        $bank_nodal->mobile = $request->input('mobile');

        $bank_nodal->password = Hash::make($request->input('password'));

        $bank_nodal->email = $request->input('email');

        $bank_nodal->is_active = 1;

        $bank_nodal->user_type_id = 2;
    
    $bank_nodal->update();                 

    return redirect('/cms-admin/bank-nodals');        
    }

    // public function destroy(string $id)             
    // {
    //     $bank_nodal = DcosContact::find($id);    
    //     $bank_nodal->delete();        
    //     return redirect('/cms-admin/bank-nodals');                                                                  
    // }

    public function destroy(string $id)             
{
    $bank_nodal = DB::table('bank_nodals')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/bank-nodals');
}

public function adminDashboard()
{
    $all = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
    ->count();

    $verified = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Verified')
    ->count();

    $inProcess = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'In Process')
    ->count();

    $sendBackToUser = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Send back to user')
    ->count();

    $accepted = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Approved')
    ->count();

    $rejected = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
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

    return view('dashboard', compact('all', 'verified', 'inProcess', 'sendBackToUser', 'accepted', 'rejected', 'statuses'));
}

public function filterapplyloan(Request $request)
{
    $status = $request->query('status');
    $search = $request->query('search');
    $lastChatDate = $request->query('created_at');
    $applyDate = $request->query('apply_date');

    try {
        $applyloan = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
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

        return view('admin.filterapplyloan', compact('applyloan', 'search', 'status', 'lastChatDate'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred. Please try again.');
    }
}


public function applicantView(int $applicantId)
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
    return view('admin.applicantview', ['applicant' => $applicant]);
}

public function messagesSend($applicantId)
{
    $messages = Message::where('applicant_id', $applicantId)
        ->with('user')
        ->get();

    // Fetch the status of the applicant
    $applicantStatus = Applys::where('id', $applicantId)->value('status');

    return view('admin.chat', compact('messages', 'applicantId', 'applicantStatus'));
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
    $user = User::find(auth()->user()->id);

    $message = Message::create([
        'applicant_id' => $applicantId,
        'user_id' => auth()->user()->id,
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
