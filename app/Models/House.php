<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    public function property(){

        return $this->belongsTo(Property::class);

    }

    public function room(){

        return $this->belongsTo(Room::class);

    }

    public function studio(){

        return $this->belongsTo(Studio::class);

    }

    public function apartment(){

        return $this->belongsTo(Apartment::class);

    }
}
