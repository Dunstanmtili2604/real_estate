<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Property;
use App\Models\Land;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Image;
use Auth;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lands = Land::with('property')->latest()->paginate(10);
        return view('admin.property.land.index', compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.property.land.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|min:3',
            'type' => 'required',
            'description' => 'required|min:100',
            'region_id' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'city' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'size' => 'required|integer',
            'quater' => 'required',
            'action' => 'required'   
        ]);

        if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
               //$image->move(public_path('uploads/images/property/land'), $name);
               Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/land/' . $name));
               $data[] = $name;  
           }
        }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = $request->input('name');
        $property->type = $request->input('type');
        $property->description =$request->input('description');
        $property->region_id = $request->input('region_id');
        $property->amount = $request->input('price');
        $property->city = $request->input('city');
        $property->quater = $request->input('quater');
        $property->image = json_encode($data);
        $property->action = $request->input('action');
        $property->save();

        $land = new Land;
        $land->property()->associate($property);
        $land->size = $request->input('size');
        $land->save();

        $favorite = new Favorite;
        $favorite->property()->associate($property);
        $favorite->land()->associate($land);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('land.index')->with(['status'=>'success','message'=>'Land added successfully!!!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Land $land)
    {
        if ($land->property->user_id == auth()->id()) {
            $regions = Region::all();
            return view('admin.property.land.edit', compact('land', 'regions'), array('user' => Auth::user()));
        } else {

            Alert::error('Your request has been denied by the system', 'Unauthorized Attempt')->autoclose(3000);
            return redirect()->route('land.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land $land)
    {
        // Retrieve the order by ID
        $lan = Land::findOrFail($land);

        // Access the associated property
        $property = $lan->property;

        // Access the associated user 
        $user = $property->user;

        if ($land->property->user_id == auth()->id()) {

            DB::table('lands')->where('id', '=', $land->id)->delete();
            DB::table('properties')->where('id', '=', $land->property->id)->delete();

            Alert::success('Your property has been deleted successfully!', 'Successfully Deleted!')->autoclose(3000);
            return redirect()->route('land.index');
        } else {

            Alert::error('Your request has been denied by the system', 'Unauthorized Attempt')->autoclose(3000);
            return redirect()->route('land.index');

        }
    }
}
