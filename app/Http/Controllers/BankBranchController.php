<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line
use App\Mail\UserCreated;

class BankBranchController extends Controller
{
    public function index()
    {
        $bank = User::where('is_active',1)->where('user_type_id',2)->get();
        return view('bank_branches.BankBranches.form',compact('bank'));              
    }

    
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'bank_id' => 'required|string|max:255',
        'email' => 'required|email',  
        'mobile' => 'required',  
        'branch_address' => 'required',
        'concerned_person' => 'required',
 ]);

 // Generate a random password
 $password = Str::random(12); // Assuming you are using the Illuminate\Support\Str class
 
 $bank_branch = User::create([
    'sort_col' => $data['sort_col'],
    'bank_id' => $data['bank_id'], 
    'email' => $data['email'],
    'mobile' => $data['mobile'],
    'password' => Hash::make($password), // Use the generated password directly
    'is_active' => 1, // Set the default value for the 'active' field 
    'user_type_id' => 3, 
    'branch_address' => $data['branch_address'],
    'concerned_person' => $data['concerned_person'],
 ]);
      
    // Adjust the data array to include the password for the email
    $data['password'] = $password; // Add this line to include the password in the data array
    
    // Now, you can safely pass $data to the view or mail class, and it will include the 'password'

    Mail::send('admin.bank_branch_mail', $data, function($message) use ($data){
        $message->to($data['email'], $data['concerned_person']);  
        $message->subject('Login with this credentials');   
    });

 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/bank-branches/branches');   

}

 public function show()
    {  
        $bank_branch = User::where('is_active',1)->where('user_type_id',3)->orderBy('sort_col', 'asc')->get();
        return view('bank_branches.BankBranches.index')           
            ->with('bank_branch', $bank_branch);       
    }

    public function edit(string $id)
    {
        $bank = User::where('is_active',1)->where('user_type_id',2)->get();
        $bank_branch = User::find($id);                 
        // show the edit form and pass the   
        return view('bank_branches.BankBranches.edit',compact('bank_branch','bank'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $bank_branch = User::find($id);  
        
        $bank_branch->sort_col = $request->input('sort_col');

        $bank_branch->bank_id = $request->input('bank_id');

        $bank_branch->concerned_person = $request->input('concerned_person');

        $bank_branch->branch_address = $request->input('branch_address');

        $bank_branch->mobile = $request->input('mobile');

        $bank_branch->email = $request->input('email');

        $bank_branch->is_active = 1;

        $bank_branch->user_type_id = 3;
    
    $bank_branch->update();                 

    return redirect('/bank-branches/branches');        
    }

    public function destroy(string $id)             
    {
        $dcosContact = DB::table('users')->where('id', $id)->update(['is_active' => 0]);
    
        return redirect('/bank-branches/branches');
    }

}
