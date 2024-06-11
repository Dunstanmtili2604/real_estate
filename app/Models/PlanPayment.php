<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPayment extends Model
{
    use HasFactory;
    protected $table = 'payment_plan';

    public function rentpayment()
    {
    	return $this->hasMany('App\Models\RentPayment');
    }
}
