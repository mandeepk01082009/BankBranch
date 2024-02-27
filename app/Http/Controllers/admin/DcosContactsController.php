<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DcosContact; 
use Illuminate\Support\Facades\DB;

class DcosContactsController extends Controller
{
    public function index()
    {
        return view('admin.dcosContacts.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'bank_name' => 'required|string|max:255',
        'dco_name' => 'required|string|max:255',
        'email' => 'required|email',  
        'mobile' => 'required',    
 ]);
 
 $dcosContacts = DcosContact::create([
    'sort_col' => $request->input('sort_col'), 
    'bank_name' => $request->input('bank_name'), 
    'dco_name' => $request->input('dco_name'), 
    'email' => $request->input('email'), 
    'mobile' => $request->input('mobile'), 
    'status' => 1, // Set the default value for the 'active' field 
 ]);
      
     $dcosContacts->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/dcos_contacts');   

}

 public function show()
    {  
        $dcosContact = DcosContact::where('status',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.dcosContacts.index')           
            ->with('dcosContact', $dcosContact);         
    }

    public function edit(string $id)
    {
        $dcosContacts = DcosContact::find($id);                 
        // show the edit form and pass the   
        return view('admin.dcosContacts.edit',compact('dcosContacts'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $dcosContacts = DcosContact::find($id);  
        
        $dcosContacts->sort_col = $request->input('sort_col');

        $dcosContacts->bank_name = $request->input('bank_name');

        $dcosContacts->dco_name = $request->input('dco_name');

        $dcosContacts->mobile = $request->input('mobile');

        $dcosContacts->email = $request->input('email');

        $dcosContacts->status = 1;
    
    $dcosContacts->update();                 

    return redirect('/cms-admin/dcos_contacts');        
    }

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/dcos_contacts');                                                                  
    // }

    public function destroy(string $id)             
{
    $dcosContact = DB::table('dcos_contacts')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/dcos_contacts');
}

}
