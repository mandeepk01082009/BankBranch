<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DcosContact;
use App\Models\Services;
use Illuminate\Support\Facades\DB;



class ServicesController extends Controller
{
    public function index()
    {
        return view('admin.services.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'service_name' => 'required|string|max:255',
        'link' => 'required',
        'logo' => 'required|image',     
 ]);
 
 $services = Services::create([
    'sort_col' => $request->input('sort_col'), 
    'service_name' => $request->input('service_name'), 
    'link' => $request->input('link'), 
    'logo' => '', 
    'status' => 1, // Set the default value for the 'active' field 
 ]);

 if($request->has('logo')) {  
    $file = $request->file('logo');
    $extention = $file->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $file->move('storage/',$filename);
    $services->logo = $filename;       
}   
     $services->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/services');   

}

 public function show()
    {  
        $service = Services::where('status',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.services.index')           
            ->with('service', $service);         
    }

    public function edit(string $id)
    {
        $service = Services::find($id);                 
        // show the edit form and pass the   
        return view('admin.services.edit',compact('service'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $service = Services::find($id);  
        
        $service->sort_col = $request->input('sort_col');

        $service->service_name = $request->input('service_name');

        $service->link = $request->input('link');

        $service->status = 1;

        if($request->has('logo')) {
            $file = $request->file('logo');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $service->logo = $filename;       
    }

    dd($service);

    
    $service->update();                 

    return redirect('/cms-admin/services');        
    }

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/services');                                                                  
    // }

    public function destroy(string $id)             
{
    $dcosContact = DB::table('services')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/services');
}

}
