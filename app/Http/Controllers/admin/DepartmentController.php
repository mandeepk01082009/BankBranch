<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department; 
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.department.form');              
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
 
  // Additionally, create a user in the users table
        $user = User::create([
            'email' => $data['email'],
            'password' => $department->password,
            'user_type_id' => 2, // Set the default value directly
            'user_id' => $department->id, // Assign the id of the BankNodal to bank_nodal_id
        ]);   
      
     // Adjust the data array to include the password for the email
     $data['password'] = $password; // Add this line to include the password in the data array
    
     // Now, you can safely pass $data to the view or mail class, and it will include the 'password'
 
     Mail::send('admin.department_mail', $data, function($message) use ($data){
         $message->to($data['email'], $data['contact_person']);  
         $message->subject('Login with this credentials');   
     });
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/departments');   

}

 public function show()
    {  
        $department = Department::where('is_active',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.department.index')           
            ->with('department', $department);         
    }

    public function edit(string $id)
    {
        $department = Department::find($id);                 
        // show the edit form and pass the   
        return view('admin.department.edit',compact('department'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $department = Department::find($id);  
        
        $department->sort_col = $request->input('sort_col');

        $department->department_name = $request->input('department_name');

        $department->contact_person = $request->input('contact_person');

        $department->mobile = $request->input('mobile');

        $department->email = $request->input('email');

        $department->password = Hash::make($request->input('password'));

        $department->is_active = 1;

        $department->user_type_id = 4;
    
    $department->update();                 

    return redirect('/cms-admin/departments');        
    }

    // public function destroy(string $id)             
    // {
    //     $departments = Department::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/departments');                                                                  
    // }

    public function destroy(string $id)             
{
    $department = DB::table('departments')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/departments');
}

}
