<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

 $department = User::create([
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
        $department = auth()->user();
        return view('department.dept.index')           
            ->with('department', $department);         
    }

    public function edit(string $id)
    {
        $department = User::find($id);                 
        // show the edit form and pass the   
        return view('department.dept.edit',compact('department'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $department = User::find($id);  
        
        $department->sort_col = $request->input('sort_col');

        $department->department_name = $request->input('department_name');

        $department->contact_person = $request->input('contact_person');

        $department->mobile = $request->input('mobile');

        $department->email = $request->input('email');

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
    $department = DB::table('users')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/department/depts');
}

}
