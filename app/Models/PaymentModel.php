<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $fillable = [
        'payment_method',
    ];

    function orders()
    {
        return $this->hasMany(Order::class, 'payment_id');
    }
}
