<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DcosContact; 
use App\Models\BankBranches;

class BankBranchesController extends Controller
{
    public function index()
    {
        $bank = DcosContact::where('status',1)->get();
        return view('admin.BankBranches.form',compact('bank'));              
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
 
 $bank_branch = BankBranches::create([
    'sort_col' => $request->input('sort_col'), 
    'bank_id' => $request->input('bank_id'), 
    'email' => $request->input('email'), 
    'mobile' => $request->input('mobile'), 
    'status' => 1, // Set the default value for the 'active' field 
    'branch_address' => $request->input('branch_address'), 
    'concerned_person' => $request->input('concerned_person'), 
 ]);
      
     $bank_branch->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/bank_branches');   

}

 public function show()
    {  
        $bank_branch = BankBranches::where('status',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.BankBranches.index')           
            ->with('bank_branch', $bank_branch);       
    }

    public function edit(string $id)
    {
        $bank = DcosContact::where('status',1)->get();
        $bank_branch = BankBranches::find($id);                 
        // show the edit form and pass the   
        return view('admin.BankBranches.edit',compact('bank_branch','bank'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $bank_branch = BankBranches::find($id);  
        
        $bank_branch->sort_col = $request->input('sort_col');

        $bank_branch->bank_id = $request->input('bank_id');

        $bank_branch->concerned_person = $request->input('concerned_person');

        $bank_branch->branch_address = $request->input('branch_address');

        $bank_branch->mobile = $request->input('mobile');

        $bank_branch->email = $request->input('email');

        $bank_branch->status = 1;
    
    $bank_branch->update();                 

    return redirect('/cms-admin/bank_branches');        
    }

    public function destroy(string $id)             
    {
        $dcosContact = DB::table('bank_branches')->where('id', $id)->update(['status' => 0]);
    
        return redirect('/cms-admin/bank_branches');
    }

}
