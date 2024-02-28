<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department; 
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
        'contact' => 'required',    
 ]);
 
 $department = Department::create([
    'sort_col' => $request->input('sort_col'), 
    'department_name' => $request->input('department_name'), 
    'contact_person' => $request->input('contact_person'), 
    'email' => $request->input('email'), 
    'contact' => $request->input('contact'), 
    'status' => 1, // Set the default value for the 'active' field 
 ]);
      
     $department->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/departments');   

}

 public function show()
    {  
        $department = Department::where('status',1)->orderBy('sort_col', 'asc')->get();
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

        $department->contact = $request->input('contact');

        $department->email = $request->input('email');

        $department->status = 1;
    
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
    $department = DB::table('departments')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/departments');
}

}
