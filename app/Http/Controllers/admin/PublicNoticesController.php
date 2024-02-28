<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublicNotices;
use Illuminate\Support\Facades\DB;


class PublicNoticesController extends Controller
{
    public function index()
    {
        return view('admin.PublicNotices.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'title' => 'required|string|max:255',
        'notice' => 'required|mimes:pdf,doc,docx',     
 ]);
 
 
 $public_notice = PublicNotices::create([
    'sort_col' => $request->input('sort_col'), 
    'title' => $request->input('title'), 
    'notice' => '', 
    'status' => 1, // Set the default value for the 'active' field 
 ]);

 if($request->has('notice')) {  
    $file = $request->file('notice');
    $extention = $file->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $file->move('storage/',$filename);
    
    $public_notice->notice = $filename;       
}   
     
$public_notice->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/public_notices');   

}

 public function show()
    {         
        $public_notice = PublicNotices::where('status',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.PublicNotices.index')           
            ->with('public_notice',$public_notice);         
    }

    public function edit(string $id)
    {
        
        $public_notice = PublicNotices::find($id);                 
        // show the edit form and pass the   
        return view('admin.PublicNotices.edit',compact('public_notice'));         
    }    

    public function update(Request $request, string $id)
{
    $data = $request->validate([
        'sort_col' => 'required|integer',
        'title' => 'required|string|max:255',
 ]);
    
 $public_notice = PublicNotices::find($id);  
 
    $public_notice->sort_col = $request->input('sort_col');
    
    $public_notice->title = $request->input('title');
    
    $public_notice->status = 1;

    if ($request->hasFile('notice')) {
        $file = $request->file('notice');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('storage'), $filename);
        $public_notice->notice = $filename; // Corrected variable here
    }
    

    
    $public_notice->update();                 

    return redirect('/cms-admin/public_notices');        
}

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/public_notices');                                                                  
    // }

    public function destroy(string $id)             
{
    
    $public_notice = DB::table('public_notices')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/public_notices');
}
}
