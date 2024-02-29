<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DcosContact; 
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

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
    
        // Generate a random password
        $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class
    
        // Correctly use the generated password when creating the user
        $dcosContacts = User::create([
            'sort_col' => $data['sort_col'],
            'bank_name' => $data['bank_name'],
            'dco_name' => $data['dco_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($password), // Use the generated password directly
            'is_active' => 1,
            'user_type_id' => 2,
        ]);
    
        // Adjust the data array to include the password for the email
        $data['password'] = $password; // Add this line to include the password in the data array
    
        // Now, you can safely pass $data to the view or mail class, and it will include the 'password'
    
        Mail::send('admin.mail', $data, function($message) use ($data){
            $message->to($data['email'], $data['dco_name']);  
            $message->subject('Login with this credentials');   
        });
    
        return redirect('/cms-admin/dcos_contacts');
    }
    
 public function show()
    {  
        $dcosContact = User::where('is_active',1)->where('user_type_id',2)->orderBy('sort_col', 'asc')->get();
        return view('admin.dcosContacts.index')           
            ->with('dcosContact', $dcosContact);         
    }

    public function edit(string $id)
    {
        $dcosContacts = User::find($id);                 
        // show the edit form and pass the   
        return view('admin.dcosContacts.edit',compact('dcosContacts'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $dcosContacts = User::find($id);  
        
        $dcosContacts->sort_col = $request->input('sort_col');

        $dcosContacts->bank_name = $request->input('bank_name');

        $dcosContacts->dco_name = $request->input('dco_name');

        $dcosContacts->mobile = $request->input('mobile');

        // $dcosContacts->password = $request->input('password');

        $dcosContacts->email = $request->input('email');

        $dcosContacts->is_active = 1;

        $dcosContacts->user_type_id = 2;
    
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
    $dcosContact = DB::table('users')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/dcos_contacts');
}

}
