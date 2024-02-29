<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department; 
use App\Models\User; 
use Illuminate\Support\Facades\DB;

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
        'password' => 'required',    
 ]);
 $department = User::create([
    'sort_col' => $request->input('sort_col'), 
    'department_name' => $request->input('department_name'), 
    'contact_person' => $request->input('contact_person'), 
    'email' => $request->input('email'), 
    'mobile' => $request->input('mobile'), 
    'password' => $request->input('password'), 
    'is_active' => 1, // Set the default value for the 'active' field 
    'user_type_id' => 4,
 ]);
      
     $department->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/departments');   

}

 public function show()
    {  
        $department = User::where('is_active',1)->where('user_type_id',4)->orderBy('sort_col', 'asc')->get();
        return view('admin.department.index')           
            ->with('department', $department);         
    }

    public function edit(string $id)
    {
        $department = User::find($id);                 
        // show the edit form and pass the   
        return view('admin.department.edit',compact('department'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $department = User::find($id);  
        
        $department->sort_col = $request->input('sort_col');

        $department->department_name = $request->input('department_name');

        $department->contact_person = $request->input('contact_person');

        $department->mobile = $request->input('mobile');

        $department->email = $request->input('email');

        $department->password = $request->input('password');

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
    $department = DB::table('users')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/departments');
}

}
