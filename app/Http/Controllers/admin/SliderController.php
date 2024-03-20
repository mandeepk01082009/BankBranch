<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DcosContact;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        // 'sort_col' => 'required|integer',
        // 'title' => 'required|string|max:255',
        // 'description' => 'required',
        'image' => 'required|image',     
 ]);
 
 $slider = Slider::create([
    // 'sort_col' => $request->input('sort_col'), 
    'title' => $request->input('title'), 
    'description' => $request->input('description'), 
    'image' => '', 
    'status' => 1, // Set the default value for the 'active' field 
 ]);

 if($request->has('image')) {  
    $file = $request->file('image');
    $extention = $file->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $file->move('storage/',$filename);
    $slider->image = $filename;       
}   
     $slider->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/sliders');   

}

 public function show()
    {  
        $slider = Slider::where('status',1)->get();
        return view('admin.slider.index')           
            ->with('slider', $slider);         
    }

    public function edit(string $id)
    {
        $slider = Slider::find($id);                 
        // show the edit form and pass the   
        return view('admin.slider.edit',compact('slider'));         
    }    

    public function update(Request $request, string $id)
{
    $slider = Slider::find($id);  
    
    // $slider->sort_col = $request->input('sort_col');
    $slider->title = $request->input('title');
    $slider->description = $request->input('description');
    $slider->status = 1;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('storage'), $filename);
        $slider->image = $filename;
    }

    $slider->update();                 

    return redirect('/cms-admin/sliders');        
}

    // public function destroy(string $id)             
    // {
    //     $dcosContacts = DcosContact::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/sliders');                                                                  
    // }

    public function destroy(string $id)             
{
    $slider = DB::table('sliders')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/sliders');
}
}
