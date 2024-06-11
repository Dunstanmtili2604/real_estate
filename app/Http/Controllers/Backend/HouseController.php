<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::with('property')->latest()->paginate(10);
        return view('admin.property.house.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.property.house.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
               $image->move(public_path().'uploads/images/property/house', $name);
               $data[] = $name;  
           }
        }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = $request->input('name');
        $property->type = $request->input('type');
        $property->description =$request->input('description');
        $property->region_id = $request->input('region_id');
        $property->city = $request->input('city');
        $property->quater = $request->input('quater');
        $property->image = json_encode($data);
        $property->action = $request->input('action');
        $property->save();

        $house = new House;
        $house->property()->associate($property);
        $house->bedrooms = $request->input('bedrooms');
        $house->bathrooms = $request->input('bathrooms');
        $house->living_rooms = $request->input('livingrooms');
        $house->fence = $request->input('fence');
        $house->packing = $request->input('parking');
        $house->swimming_pool = $request->input('swimming_pool');
        $house->save();

        return redirect()->view('admin.property.house.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
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
    public function edit(House $house)
    {
        $regions = Region::all();
        return view('admin.property.house.edit', compact('house', 'regions'));
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
    public function destroy(string $id)
    {
        //
    }
}
