<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GovtSchemes; 

class GovtSchemesController extends Controller
{
    public function index()
    {
        return view('admin.govtSchemes.form');              
    }
   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'name_of_ministry' => 'required|string|max:255',
        'name_of_departments' => 'required|string|max:255',
        'sector' => 'required', 
        'scheme' => 'required',  
        'sub_scheme' => 'required',
        'objective' => 'required',  
        'beneficaries_type' => 'required',  
        'grant' => 'required',   
        'source_of_information' => 'required',   
 ]);
 
 $govt_schemes = GovtSchemes::create([
    'sort_col' => $request->input('sort_col'), 
    'name_of_ministry' => $request->input('name_of_ministry'), 
    'name_of_departments' => $request->input('name_of_departments'), 
    'sector' => $request->input('sector'), 
    'scheme' => $request->input('scheme'), 
    'sub_scheme' => $request->input('sub_scheme'), 
    'objective' => $request->input('objective'), 
    'beneficaries_type' => $request->input('beneficaries_type'), 
    'grant' => $request->input('grant'), 
    'source_of_information' => $request->input('source_of_information'),
    'status' => 1, // Set the default value for the 'active' field 
    'remark' => $request->input('remark'), 
 ]);
      
  $govt_schemes->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/govt_schemes');   

}

 public function show()
    {  
        $govt_schemes = GovtSchemes::orderBy('sort_col', 'asc')->get();
        return view('admin.govtSchemes.index')           
            ->with('govt_schemes', $govt_schemes);         
    }

    public function edit(string $id)
    {
        $govt_schemes = GovtSchemes::find($id);                 
        // show the edit form and pass the   
        return view('admin.govtSchemes.edit',compact('govt_schemes'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $govt_schemes = GovtSchemes::find($id);  
        
        $govt_schemes->name_of_ministry = $request->input('name_of_ministry');

        $govt_schemes->name_of_departments = $request->input('name_of_departments');

        $govt_schemes->sector = $request->input('sector');

        $govt_schemes->scheme = $request->input('scheme');

        $govt_schemes->sub_scheme = $request->input('sub_scheme');

        $govt_schemes->objective = $request->input('objective');

        $govt_schemes->beneficaries_type = $request->input('beneficaries_type');

        $govt_schemes->grant = $request->input('grant');

        $govt_schemes->source_of_information = $request->input('source_of_information');

        $govt_schemes->status = 1;

        $govt_schemes->remark = $request->input('remark');
    
    $govt_schemes->update();                 

    return redirect('/cms-admin/govt_schemes');        
    }

    public function destroy(string $id)             
    {
        $govt_schemes = GovtSchemes::find($id);    
        $govt_schemes->delete();        
        return redirect('/cms-admin/govt_schemes');                                                                  
    }

}
