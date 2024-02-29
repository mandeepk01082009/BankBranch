<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\DB;

class BankNodalsController extends Controller
{
    public function index()
    {
        return view('bank_nodals.dcosContacts.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'bank_name' => 'required|string|max:255',
        'dco_name' => 'required|string|max:255',
        'email' => 'required|email',  
        'password' => 'required',
        'mobile' => 'required',    
 ]);
 
 $dcosContacts = User::create([
    'sort_col' => $request->input('sort_col'), 
    'bank_name' => $request->input('bank_name'), 
    'dco_name' => $request->input('dco_name'), 
    'email' => $request->input('email'), 
    'mobile' => $request->input('mobile'), 
    'password' => $request->input('password'), 
    'is_active' => 1, // Set the default value for the 'active' field 
    'user_type_id' => 2,
 ]);
      
     $dcosContacts->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('bank-nodals/dcos_contacts');   

}

 public function show()
    {  
        $dcosContact = User::where('is_active',1)->where('user_type_id',2)->orderBy('sort_col', 'asc')->get();
        return view('bank_nodals.dcosContacts.index')           
            ->with('dcosContact', $dcosContact);         
    }

    public function edit(string $id)
    {
        $dcosContacts = User::find($id);                 
        // show the edit form and pass the   
        return view('bank_nodals.dcosContacts.edit',compact('dcosContacts'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $dcosContacts = User::find($id);  
        
        $dcosContacts->sort_col = $request->input('sort_col');

        $dcosContacts->bank_name = $request->input('bank_name');

        $dcosContacts->dco_name = $request->input('dco_name');

        $dcosContacts->mobile = $request->input('mobile');

        $dcosContacts->password = $request->input('password');

        $dcosContacts->email = $request->input('email');

        $dcosContacts->is_active = 1;

        $dcosContacts->user_type_id = 2;
    
    $dcosContacts->update();                 

    return redirect('bank-nodals/dcos_contacts');        
    }

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('bank-nodals/dcos_contacts');                                                                  
    // }

    public function destroy(string $id)             
{
    $dcosContact = DB::table('users')->where('id', $id)->update(['is_active' => 0]);

    return redirect('bank-nodals/dcos_contacts');
}

}
