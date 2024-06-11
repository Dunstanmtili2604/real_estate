<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use DB;

class PropertyController extends Controller
{
    public function properties() {
        $currentUser = auth()->user();
        if ($currentUser->role == 'admin') {
            $values = DB::table('properties')->get();
        } else {
            $values = DB::table('properties')->where('user_id', $currentUser->id)->get();
        }

        // Pass $products to your view
        return view('property.property_listing', compact('properties'));
    }
    
    public function propertyActivate(Request $request){
        $property_id = $request->property_id;

        // check whether activate or de-activate
        if ($request->current_status == "1"){
            return $this->propertyDeActivate($property_id);
        }

        try {
            $agent = User::findOrFail($property_id);
            $agent->update(['status' => 1]);

            return redirect()->route('admin.property.land.index')->with('success', 'Property activated successfully');
        }catch (ModelNotFoundException $exception){
            return redirect()->view('admin.property.land.index')->with('error', 'Failed to activate this property, try again');
        }
    }

    public function propertyDeActivate(int $property_id){

        try {
            Property::findOrFail($property_id)->update(['status' => 0]);
            return redirect()->route('admin.property.land.index')->with('success', 'Property deactivated successfully');
        }catch (ModelNotFoundException $exception){
            return redirect()->view('admin.property.land.index')->with('error', 'Failed to deactivate this property, try again');
        }
    }
}
