<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CSRCategory;
use App\Models\csr_categorys;
use Illuminate\Support\Facades\DB;

class CSRCategoryController extends Controller
{
    public function index()
    {
        return view('admin.csr_category.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'csr_category_name' => 'required|string|max:255',
        'logo' => 'required|image',     
 ]);
 
 $csr_category = CSRCategory::create([
    'sort_col' => $request->input('sort_col'), 
    'csr_category_name' => $request->input('csr_category_name'), 
    'logo' => '', 
    'is_active' => 1, // Set the default value for the 'active' field 
 ]);

 if($request->has('logo')) {  
    $file = $request->file('logo');
    $extention = $file->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $file->move('storage/',$filename);
    $csr_category->logo = $filename;       
}   
     $csr_category->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/csr_categories');   

}

 public function show()
    {  
        $csr_category = CSRCategory::where('is_active',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.csr_category.index')           
            ->with('csr_category', $csr_category);         
    }

    public function edit(string $id)
    {
        $csr_category = CSRCategory::find($id);                 
        // show the edit form and pass the   
        return view('admin.csr_category.edit',compact('csr_category'));         
    }    

    public function update(Request $request, string $id)
{
    $csr_category = CSRCategory::find($id);  
    
    $csr_category->sort_col = $request->input('sort_col');
    $csr_category->csr_category_name = $request->input('csr_category_name');
    $csr_category->is_active = 1;

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('storage'), $filename);
        $csr_category->logo = $filename;
    }

    $csr_category->update();                 

    return redirect('/cms-admin/csr_categories');        
}

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/csr_categories');                                                                  
    // }

    public function destroy(string $id)             
{
    $dcosContact = DB::table('csr_categories')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/csr_categories');
}

    
}
