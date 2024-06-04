<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Department; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;
use App\Models\CSR_Request;
use App\Models\CSRCategory;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department.dept.form');              
    }

    
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'department_name' => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'email' => 'required|email',  
        'mobile' => 'required',   
 ]);

 // Generate a random password
 $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class

 $department = Department::create([
    'sort_col' => $data['sort_col'],
    'department_name' =>$data['department_name'], 
    'contact_person' => $data['contact_person'], 
   'email' => $data['email'],
   'mobile' => $data['mobile'],
   'password' => Hash::make($password), // Use the generated password directly
    'is_active' => 1, // Set the default value for the 'active' field 
    'user_type_id' => 4,
 ]);
      
     // Adjust the data array to include the password for the email
     $data['password'] = $password; // Add this line to include the password in the data array
    
     // Now, you can safely pass $data to the view or mail class, and it will include the 'password'
 
     Mail::send('admin.department_mail', $data, function($message) use ($data){
         $message->to($data['email'], $data['contact_person']);  
         $message->subject('Login with this credentials');   
     });
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/department/depts');   

}

 public function show()
{  
   $departmentId = auth('departments')->user()->id;

   $department = DB::table('departments')
        ->where('id',$departmentId)
        ->first();

        return view('department.dept.index', compact('department'));
}

//  public function show()
//     {  
//         //dd(session()->all());
//         $departmentId = session('department_id');
//         // Query the bank_nodals table to get the bank nodal details
//         $department = DB::table('departments')->where('id', $departmentId)->first();
//         //dd($department);
//          return view('department.dept.index', compact('department'));      
//     }

    public function edit(string $id)
    {
        $department = Department::find($id);                 
        // show the edit form and pass the   
        return view('department.dept.edit',compact('department'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $department = Department::find($id);  
        
        //$department->sort_col = $request->input('sort_col');

        $department->department_name = $request->input('department_name');

        $department->contact_person = $request->input('contact_person');

        $department->mobile = $request->input('mobile');

        $department->email = $request->input('email');

        $department->password = Hash::make($request->input('password'));

        $department->is_active = 1;

        $department->user_type_id = 4;
    
    $department->update();                 

    return redirect('/department/depts');        
    }

    // public function destroy(string $id)             
    // {
    //     $departments = Department::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/department/depts');                                                                  
    // }

    public function destroy(string $id)             
{
    $department = DB::table('departments')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/department/depts');
}

public function departmentDashboard()
{
    $bank_branch_id = auth('departments')->user()->id;
    // Count the number of apply_loan records where status is Pending and bankBranch matches the bank_branch_id
//     $all = Applys::where('bankBranch', $bank_branch_id)
//     ->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
//         $query->where('status', '!=', 'Deleted');
//     }])
//     ->count();

// $verified = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
// $query->where('status', '!=', 'Deleted');
// }])
// ->where('status', 'Verified')
// ->count();

// $inProcess = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
//     $query->where('status', '!=', 'Deleted');
// }])
//     ->where('status', 'In Process')
// ->count();

// $sendBackToUser = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
//     $query->where('status', '!=', 'Deleted');
// }])
//     ->where('status', 'Send back to user')
// ->count();

// $accepted = Applns::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
//     $query->where('status', '!=', 'Deleted');
// }])
//     ->where('status', 'Approved')
// ->count();

// $rejected = Applys::where('bankBranch', $bank_branch_id)->with(['bankNodal', 'bankBranches', 'messages' => function($query) {
//     $query->where('status', '!=', 'Deleted');
// }])
//     ->where('status', 'Rejected')
// ->count();


// $statuses = [
//     'Verified',
//     'In Process',
//     'Send back to user',
//     'Approved',
//     'Rejected'
// ];

    return view('department.dashboard');
}

public function addCsrRequest()
{
    $csr_category = CSRCategory::where('is_active',1)->get();
    return view('department.csr_request.form',compact('csr_category'));
}

public function storeCsrRequest(Request $request)
{
    $data = $request->validate([
       'csr_category_id' => 'required|string|max:255', 
       'reason' => 'required',
       'description' => 'required',
       'banner' => 'required|image',
       'amount' => 'required',

]);

$department_id = auth('departments')->user()->id;

$csr_request = CSR_Request::create([
   'department_id' => $department_id, 
   'csr_category_id' => $request->input('csr_category_id'), 
   'reason' => $request->input('reason'), 
   'description' => $request->input('description'),
   'banner' => '', 
   'amount' => $request->input('amount'),
   'is_active' => 1, // Set the default value for the 'active' field 
]);

if($request->has('banner')) {  
    $file = $request->file('banner');
    $extention = $file->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $file->move('storage/',$filename);
    $csr_request->banner = $filename;       
}   
    
  $csr_request->save();

// return response()->json(['success'=>'Files uploaded successfully.']); 
 
 return redirect('/department/csr_requests');
}

public function viewCsrRequest()
{  
    $department_id = auth('departments')->user()->id;
    $csr_request = CSR_Request::where('department_id',$department_id)->get();
    //dd($csr_request);
    return view('department.csr_request.index',compact('csr_request'));                    
}

public function editCsrRequest(string $id)
    {
        $csr_category = CSRCategory::where('is_active',1)->get();
        $csr_request = CSR_Request::find($id);                 
        // show the edit form and pass the   
        return view('department.csr_request.edit',compact('csr_request','csr_category'));         
    }    

public function updateCsrRequest(Request $request, string $id)
    {
       
        $csr_request = CSR_Request::find($id);  

        $csr_request->csr_category_id = $request->input('csr_category_id');

        $csr_request->reason = $request->input('reason');

        $csr_request->description = $request->input('description');

        $csr_request->amount = $request->input('amount');

        $csr_request->is_active = 1;

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('storage'), $filename);
            $csr_request->banner = $filename;
        }
    
    
    $csr_request->update();                 

    return redirect('/department/csr_requests');
    }

}