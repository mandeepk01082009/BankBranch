<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankNodal; 
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

class BankNodalController extends Controller
{
    public function index()
    {
        return view('admin.bank_nodals.form');              
    }

   
    public function create(Request $request)
    {
        $data = $request->validate([
            'sort_col' => 'required|integer',
            'bank_name' => 'required|string|max:255|unique:bank_nodals,bank_name',
            'dco_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
    
        // Generate a random password
        $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class
    
        // Create the bank nodal
        $bank_nodal = BankNodal::create([
            'sort_col' => $data['sort_col'],
            'bank_name' => $data['bank_name'],
            'dco_name' => $data['dco_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($password),
            'is_active' => 1,
            'user_type_id' => 2,
        ]);
    
        // Additionally, create a user in the users table
        $user = User::create([
            'email' => $data['email'],
            'password' => $bank_nodal->password,
            'user_type_id' => 2, // Set the default value directly
            'user_id' => $bank_nodal->id, // Assign the id of the BankNodal to bank_nodal_id
        ]);    
    
        // Adjust the data array to include the password for the email
        $data['password'] = $password; // Include the password in the data array
    
        // Send email with credentials
        Mail::send('admin.mail', $data, function($message) use ($data) {
            $message->to($data['email'], $data['dco_name']);
            $message->subject('Login with these credentials');
        });
    
        return redirect('/cms-admin/bank-nodals');
    }
        
 public function show()
    {  
        $bank_nodal = BankNodal::where('is_active',1)->where('user_type_id',2)->orderBy('sort_col', 'asc')->get();
        return view('admin.bank_nodals.index',compact('bank_nodal'));                  
    } 

    public function edit(string $id)
    {
        $bank_nodal = BankNodal::find($id);                 
        // show the edit form and pass the   
        return view('admin.bank_nodals.edit',compact('bank_nodal'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $bank_nodal = BankNodal::find($id);  
        
        $bank_nodal->sort_col = $request->input('sort_col');

        $bank_nodal->bank_name = $request->input('bank_name');

        $bank_nodal->dco_name = $request->input('dco_name');

        $bank_nodal->mobile = $request->input('mobile');

        // $bank_nodal->password = $request->input('password');

        $bank_nodal->email = $request->input('email');

        $bank_nodal->is_active = 1;

        $bank_nodal->user_type_id = 2;
    
    $bank_nodal->update();                 

    return redirect('/cms-admin/bank-nodals');        
    }

    // public function destroy(string $id)             
    // {
    //     $bank_nodal = DcosContact::find($id);    
    //     $bank_nodal->delete();        
    //     return redirect('/cms-admin/bank-nodals');                                                                  
    // }

    public function destroy(string $id)             
{
    $bank_nodal = DB::table('bank_nodals')->where('id', $id)->update(['is_active' => 0]);

    return redirect('/cms-admin/bank-nodals');
}

}
