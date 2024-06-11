<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'region_id', 'city', 'quater','description','image','action','status'
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function house(){

        return $this->belongsTo(House::class);

    }

    public function land(){

        return $this->belongsTo(Land::class);

    }

    public function vehicle(){

        return $this->belongsTo(Vehicle::class);

    }
}
