<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schemes; 
use App\Models\User; 
use App\Models\Department; 
use Illuminate\Support\Facades\DB;

class SchemeController extends Controller
{
    public function index()
    {
        $department = User::where('is_active',1)->where('user_type_id',4)->get();
        return view('admin.schemes.form',compact('department'));              
    }
   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'department_id' => 'required|string|max:255',
        'scheme_category' => 'required|string|max:255',
        'description_of_scheme' => 'required',  
        'eligibility_criteria' => 'required',
        'website_link'   => 'required',    
 ]);
 
 $scheme = Schemes::create([
    'sort_col' => $request->input('sort_col'), 
    'department_id' => $request->input('department_id'), 
    'scheme_category' => $request->input('scheme_category'), 
    'description_of_scheme' => $request->input('description_of_scheme'), 
    'eligibility_criteria' => $request->input('eligibility_criteria'),
    'website_link' => $request->input('website_link'),  
    'active' => 1, // Set the default value for the 'active' field 
 ]);
      
     $scheme->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/schemes');   

}

 public function show()
    {  
        $scheme = Schemes::where('active',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.schemes.index')           
            ->with('scheme', $scheme);         
    }

    public function edit(string $id)
    {
        $department = User::where('is_active',1)->where('user_type_id',4)->get();
        $scheme = Schemes::find($id);                 
        // show the edit form and pass the   
        return view('admin.schemes.edit',compact('scheme','department'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $scheme = Schemes::find($id);  
        
        $scheme->sort_col = $request->input('sort_col');

        $scheme->department_id = $request->input('department_id');

        $scheme->scheme_category = $request->input('scheme_category');

        $scheme->eligibility_criteria = $request->input('eligibility_criteria');

        $scheme->description_of_scheme = $request->input('description_of_scheme');

        $scheme->website_link = $request->input('website_link');

        $scheme->active = 1;
    
    $scheme->update();                 

    return redirect('/cms-admin/schemes');        
    }

    // public function destroy(string $id)             
    // {
    //     $schemes = Department::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/schemes');                                                                  
    // }

    public function destroy(string $id)             
{
    $scheme = DB::table('schemes')->where('id', $id)->update(['active' => 0]);

    return redirect('/cms-admin/schemes');
}

    
}
