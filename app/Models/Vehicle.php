<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function property(){

        return $this->belongsTo(Property::class);

    }

    public function car(){

        return $this->belongsTo(Car::class);

    }

    public function bike(){

        return $this->belongsTo(Bike::class);

    }
}
