<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvertisementRate; 
use Illuminate\Support\Facades\DB;

class AdvertisementRateController extends Controller
{
    public function index()
    {
        return view('admin.advertisement_rate.form');              
    }

   
    public function create(Request $request)  
    {
     $data = $request->validate([
        'sort_col' => 'required|integer',
        'advertisement_slot' => 'required|string|max:255',
        'minimum_days' => 'required',
        'per_day_rate' => 'required',  
        'size' => 'required',    
 ]);
 
 $advertisement_rate = AdvertisementRate::create([
    'sort_col' => $request->input('sort_col'), 
    'advertisement_slot' => $request->input('advertisement_slot'), 
    'minimum_days' => $request->input('minimum_days'), 
    'per_day_rate' => $request->input('per_day_rate'), 
    'size' => $request->input('size'), 
    'status' => 1, // Set the default value for the 'active' field 
 ]);
      
     $advertisement_rate->save();
 
  //return response()->json(['success'=>'Files uploaded successfully.']); 
  
  return redirect('/cms-admin/advertisement_rates');   

}

 public function show()
    {  
        $advertisement_rate = AdvertisementRate::where('status',1)->orderBy('sort_col', 'asc')->get();
        return view('admin.advertisement_rate.index')           
            ->with('advertisement_rate', $advertisement_rate);         
    }

    public function edit(string $id)
    {
        $advertisement_rate = AdvertisementRate::find($id);                 
        // show the edit form and pass the   
        return view('admin.advertisement_rate.edit',compact('advertisement_rate'));         
    }    

    public function update(Request $request, string $id)
    {
       
        $advertisement_rate = AdvertisementRate::find($id);  
        
        $advertisement_rate->sort_col = $request->input('sort_col');

        $advertisement_rate->advertisement_slot = $request->input('advertisement_slot');

        $advertisement_rate->minimum_days = $request->input('minimum_days');

        $advertisement_rate->size = $request->input('size');

        $advertisement_rate->per_day_rate = $request->input('per_day_rate');

        $advertisement_rate->status = 1;
    
    $advertisement_rate->update();                 

    return redirect('/cms-admin/advertisement_rates');        
    }

    // public function destroy(string $id)             
    // {
    //     $advertisement_rates = AdvertisementRate::find($id);    
    //     $dcosContacts->delete();        
    //     return redirect('/cms-admin/advertisement_rates');                                                                  
    // }

    public function destroy(string $id)             
{
    $advertisement_rate = DB::table('advertisement_rates')->where('id', $id)->update(['status' => 0]);

    return redirect('/cms-admin/advertisement_rates');
}
}
