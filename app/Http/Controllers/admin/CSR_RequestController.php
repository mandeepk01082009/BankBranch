<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Department; 
use App\Models\CSR_Request;
use App\Models\CSRCategory;
use Illuminate\Support\Facades\DB;

class CSR_RequestController extends Controller
{
    public function index()
    {
        $department = User::where('is_active',1)->where('user_type_id',4)->get();
        $csr_category = CSRCategory::where('is_active',1)->get();
        return view('admin.csr_request.form',compact('department','csr_category'));              
    }
   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'department_id' => 'required|string|max:255',
        'csr_category_id' => 'required|string|max:255',
        'details' => 'required',  
        'estimated_expense' => 'required',
 ]);
 
 $csr_request = CSR_Request::create([
    'sort_col' => $request->input('sort_col'), 
    'department_id' => $request->input('department_id'), 
    'csr_category_id' => $request->input('csr_category_id'), 
    'details' => $request->input('details'), 
    'estimated_expense' => $request->input('estimated_expense'),
    'is_active' => 1, // Set the default value for the 'active' field 
 ]);
      
     $csr_request->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/csr_requests');   

}

 public function show()
    {  
        $csr_request = CSR_Request::where('is_active',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.csr_request.index')           
            ->with('csr_request', $csr_request);         
    }

    public function edit(string $id)
    {
        $department = User::where('is_active',1)->where('user_type_id',4)->get();
        $csr_category = CSRCategory::where('is_active',1)->get();
        $csr_request = CSR_Request::find($id);                 
        // show the edit form and pass the   
        return view('admin.csr_request.edit',compact('csr_request','department','csr_category'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $csr_request = CSR_Request::find($id);  
        
        $csr_request->sort_col = $request->input('sort_col');

        $csr_request->department_id = $request->input('department_id');

        $csr_request->csr_category_id = $request->input('csr_category_id');

        $csr_request->estimated_expense = $request->input('estimated_expense');

        $csr_request->details = $request->input('details');

        $csr_request->is_active = 1;
    
    $csr_request->update();                 

    return redirect('/cms-admin/csr_requests');        
    }

    // public function destroy(string $id)             
    // {
    //     $csr_requests = Department::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/csr_requests');                                                                  
    // }

    public function destroy(string $id)             
{
    $csr_request = DB::table('csr_requests')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/csr_requests');
}
    
}
