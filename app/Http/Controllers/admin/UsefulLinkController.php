<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsefulLinks;
use Illuminate\Support\Facades\DB;

class UsefulLinkController extends Controller
{
    public function index()
    {
        return view('admin.UsefulLinks.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'useful_link' => 'required|string|max:255',
        'link' => 'required',
        'logo' => 'required|image',     
 ]);
 
 $useful_link = UsefulLinks::create([
    'sort_col' => $request->input('sort_col'), 
    'useful_link' => $request->input('useful_link'), 
    'link' => $request->input('link'), 
    'logo' => '', 
    'status' => 1, // Set the default value for the 'active' field 
 ]);

 if($request->has('logo')) {  
    $file = $request->file('logo');
    $extention = $file->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $file->move('storage/',$filename);
    $useful_link->logo = $filename;       
}   
     $useful_link->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/useful_links');   

}

 public function show()
    {  
        $useful_link = UsefulLinks::where('status',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.UsefulLinks.index')           
            ->with('useful_link', $useful_link);         
    }

    public function edit(string $id)
    {
        $useful_link = UsefulLinks::find($id);                 
        // show the edit form and pass the   
        return view('admin.UsefulLinks.edit',compact('useful_link'));         
    }    

    public function update(Request $request, string $id)
{
    $useful_link = UsefulLinks::find($id);  
    
    $useful_link->sort_col = $request->input('sort_col');
    $useful_link->useful_link = $request->input('useful_link');
    $useful_link->link = $request->input('link');
    $useful_link->status = 1;

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('storage'), $filename);
        $useful_link->logo = $filename;
    }

    $useful_link->update();                 

    return redirect('/cms-admin/useful_links');        
}

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/useful_links');                                                                  
    // }

    public function destroy(string $id)             
{
    $useful_link = DB::table('useful_links')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/useful_links');
}

}
