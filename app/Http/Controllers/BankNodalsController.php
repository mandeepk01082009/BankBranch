<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BankNodal; 
use Illuminate\Support\Facades\DB;
use App\Models\ApplyLoans; 
use App\Models\Applys; 
use App\Models\Message;  
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

class BankNodalsController extends Controller
{
    public function index()
    {
        return view('bank_nodals.bankNodal.form');              
    }

   
    public function create(Request $request)
    {
        $data = $request->validate([
            'sort_col' => 'required|integer',
            'bank_name' => 'required|string|max:255',
            'dco_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
    
        // Generate a random password
        $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class
    
        // Correctly use the generated password when creating the user
        $bank_nodal = BankNodal::create([
            'sort_col' => $data['sort_col'],
            'bank_name' => $data['bank_name'],
            'dco_name' => $data['dco_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($password), // Use the generated password directly
            'is_active' => 1,
            'user_type_id' => 2,
        ]);
    
        // Adjust the data array to include the password for the email
        $data['password'] = $password; // Add this line to include the password in the data array
    
        // Now, you can safely pass $data to the view or mail class, and it will include the 'password'
    
        Mail::send('admin.mail', $data, function($message) use ($data){
            $message->to($data['email'], $data['dco_name']);  
            $message->subject('Login with this credentials');   
        });
    
      
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('bank-nodals/bank_nodals');   

}

public function show()
{  
    $bankNodalId = auth('bank_nodals')->user()->id;

    $bankNodal = DB::table('bank_nodals')
        ->where('id', $bankNodalId)
        ->first();

        return view('bank_nodals.bankNodal.index', compact('bankNodal'));  
}


//  public function show()
//     {  
//         $bankNodalId = session('bank_nodal_id');

//         // Query the bank_nodals table to get the bank nodal details
//         $bankNodal = DB::table('bank_nodals')->where('id', $bankNodalId)->first();
//        // dd($dcosContact);
//          return view('bank_nodals.bankNodal.index', compact('bankNodal')); 
//         // return view('bank_nodals.bankNodal.index')           
//         //     ->with('dcosContact', $dcosContact);         
//     }

    public function edit(string $id)
    {
        $bank_nodal = BankNodal::find($id);                 
        // show the edit form and pass the   
        return view('bank_nodals.bankNodal.edit',compact('bank_nodal'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $bank_nodal = BankNodal::find($id);  
        
        // $bank_nodal->sort_col = $request->input('sort_col');

       // $bank_nodal->bank_name = $request->input('bank_name');

        $bank_nodal->dco_name = $request->input('dco_name');

        $bank_nodal->mobile = $request->input('mobile');

        $bank_nodal->password = Hash::make($request->input('password'));

        $bank_nodal->email = $request->input('email');

        $bank_nodal->is_active = 1;

        $bank_nodal->user_type_id = 2;
    
    $bank_nodal->update();                 

    return redirect('bank-nodals/bank_nodals');        
    }

    // public function destroy(string $id)             
    // {
    //     $bank_nodal = DcosContact::find($id);    
    //     $bank_nodal->delete();        
    //     return redirect('bank-nodals/bank_nodals');                                                                  
    // }

    public function destroy(string $id)             
{
    $bank_nodal = DB::table('bank_nodals')->where('id', $id)->update(['is_active' => 0]);

    return redirect('bank-nodals/bank_nodals');
}

public function bankNodalDashboard()
{
    $bank_nodal_id = auth('bank_nodals')->user()->id;
        $all = ApplyLoans::where('bankName', $bank_nodal_id)
        ->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
        ->count();

$applied = Applys::where('bankName', $bank_nodal_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
    $query->where('status', '!=', 'Deleted');
}])
    ->where('status', 'Applied')
->count();

    $inProcess = Applys::where('bankName', $bank_nodal_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'In Process')
    ->count();

    $sendBackToUser = Applys::where('bankName', $bank_nodal_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Send back to user')
    ->count();

    $accepted = Applys::where('bankName', $bank_nodal_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
        $query->where('status', '!=', 'Deleted');
    }])
        ->where('status', 'Approved')
    ->count();

    $rejected = Applys::where('bankName', $bank_nodal_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
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

    return view('bank_nodals.dashboard', compact('all', 'applied', 'inProcess', 'sendBackToUser', 'accepted', 'rejected', 'statuses'));
}

// public function filterapplyloan(Request $request)
// {
//     $bank_nodal_id = auth('bank_nodals')->user()->id;
//     $status = $request->query('status');
//     $search = $request->query('search');
//     $lastChatDate = $request->query('created_at');
//     $applyDate = $request->query('apply_date');

//     try {
//         $applyloan = ApplyLoans::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
//             $query->where('status', '!=', 'Deleted');
//         }])
//         ->where(function($query) use ($status, $search, $lastChatDate, $applyDate ) {
//             $query->where(function($query) use ($status, $search, $lastChatDate, $applyDate) {
//                 if ($status) {
//                     $query->where('apply_loans.status', $status);
//                 }
        
//                 if ($search) {
//                     $query->where(function($query) use ($search) {
//                         $query->where('name', 'like', "%{$search}%")
//                             ->orWhere('email', 'like', "%{$search}%")
//                             ->orWhere('phoneNumber', 'like', "%{$search}%");
//                     });
//                 }
        
//                 if ($lastChatDate) {
//                     $query->whereHas('messages', function($query) use ($lastChatDate) {
//                         $query->whereDate('created_at', '=', $lastChatDate);
//                     });
//                 }

//                 if ($applyDate) {
//                     $query->whereDate('apply_loans.created_at', $applyDate);
//                 }
                
//             });
//         })
        
//         ->orderBy('created_at', 'desc')
//         ->simplePaginate(10);

//         return view('admin.filterapplyloan', compact('applyloan', 'search', 'status', 'lastChatDate'));
//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'An error occurred. Please try again.');
//     }
// }



public function filterapplyloan(Request $request)
{
    $bank_nodal_id = auth('bank_nodals')->user()->id;
    $status = $request->query('status');
    $search = $request->query('search');
    $lastChatDate = $request->query('created_at');
    $applyDate = $request->query('apply_date');

    try {
        $applyloan = Applys::with(['bankNodal', 'bankBranches', 'messages' => function($query) {
            $query->where('status', '!=', 'Deleted');
        }])
        ->where('bankName', $bank_nodal_id)
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

        return view('bank_nodals.filterapplyloan', compact('applyloan', 'search', 'status', 'lastChatDate'));
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
    return view('bank_nodals.applicantview', ['applicant' => $applicant]);
}

public function messagesSend($applicantId)
{
    $messages = Message::where('applicant_id', $applicantId)
    ->with('user')
    ->get();
    // Fetch the status of the applicant
    $applicantStatus = Applys::where('id', $applicantId)->value('status');

    return view('bank_nodals.chat', compact('messages', 'applicantId','applicantStatus'));
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
    $user = BankNodal::find(auth('bank_nodals')->user()->id);

    $message = Message::create([
        'applicant_id' => $applicantId,
        'user_id' => auth('bank_nodals')->user()->id,
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
