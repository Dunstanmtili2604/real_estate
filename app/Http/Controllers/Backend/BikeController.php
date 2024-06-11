<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\Vehicle;
use App\Models\Bike;
use App\Models\Favorite;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
               $image->move(public_path('uploads/images/property/vehicle/bike'), $name);
               $data[] = $name;  
           }
        }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = $request->input('name');
        $property->type = $request->input('type');
        $property->description =$request->input('description');
        $property->amount = $request->input('price');
        $property->region_id = $request->input('region_id');
        $property->city = $request->input('city');
        $property->quater = $request->input('quater');
        $property->image = json_encode($data);
        $property->action = $request->input('action');
        $property->save();

        $vehicle = new Vehicle;
        $vehicle->property()->associate($property);
        $vehicle->type = $request->input('vehicle-type');
        $vehicle->color = $request->input('color');
        $vehicle->year = $request->input('year');
        $vehicle->save();

        $bike = new Bike;
        $bike->vehicle()->associate($vehicle);
        $bike->brand = $request->input('brand');
        $bike->model = $request->input('model');
        $bike->save();

        $favorite = new Favorite;
        $favorite->property()->associate($property);
        $favorite->vehicle()->associate($vehicle);
        $favorite->bike()->associate($bike);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('vehicle.index')->with(['status'=>'success','message'=>'Car added successfully!!!']);
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
    public function edit(string $id)
    {
        //
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
