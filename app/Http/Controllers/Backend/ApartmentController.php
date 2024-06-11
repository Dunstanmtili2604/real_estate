<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\House;
use App\Models\Apartment;
use App\Models\Favorite;


class ApartmentController extends Controller
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
               $image->move(public_path('uploads/images/property/house/apartment'), $name);
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

        $house = new House;
        $house->property()->associate($property);
        $house->type = $request->input('house-type');
        $house->fence = $request->input('fence');
        $house->packing = $request->input('parking');
        $house->swimming_pool = $request->input('pool');
        $house->save();

        $apartment = new Apartment;
        $apartment->house()->associate($house);
        $apartment->type = $request->input('apartment-type');
        $apartment->livingroom = $request->input('livingroom');
        $apartment->bedroom = $request->input('bedroom');
        $apartment->bathroom = $request->input('bathroom');
        $apartment->kitchen = $request->input('kitchen');
        $apartment->balcony = $request->input('balcony');
        $apartment->save();

        $favorite = new Favorite;
        $favorite->property()->associate($property);
        $favorite->house()->associate($house);
        $favorite->apartment()->associate($apartment);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('house.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
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
