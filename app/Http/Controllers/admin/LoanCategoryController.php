<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanCategory; 
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line

class LoanCategoryController extends Controller

{
    public function index()
    {
        return view('admin.loan_category.form');              
    }

    
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'name' => 'required|string|max:255',
 ]);

 
 $loan_category = LoanCategory::create([
    'sort_col' => $data['sort_col'],
    'name' =>$data['name'], 
    'is_active' => 1, // Set the default value for the 'active' field 
 ]);
      
  return redirect('/cms-admin/loan_categories');   

}

 public function show()
    {  
        $loan_category = LoanCategory::where('is_active',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.loan_category.index')           
            ->with('loan_category', $loan_category);         
    }

    public function edit(string $id)
    {
        $loan_category = LoanCategory::find($id);                 
        // show the edit form and pass the   
        return view('admin.loan_category.edit',compact('loan_category'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $loan_category = LoanCategory::find($id);  
        
        $loan_category->sort_col = $request->input('sort_col');

        $loan_category->name = $request->input('name');

        $loan_category->is_active = 1;
    
        $loan_category->update();                 

    return redirect('/cms-admin/loan_categories');        
    }

    // public function destroy(string $id)             
    // {
    //     $loan_categorys = LoanCategory::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/loan_categories');                                                                  
    // }

    public function destroy(string $id)             
{
    $loan_category = DB::table('loan_categories')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/loan_categories');
}
}
