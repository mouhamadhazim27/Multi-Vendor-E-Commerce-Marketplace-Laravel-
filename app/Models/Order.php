<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
       'user_id', 
       'phone',
       'address',       
       'guest_email',
       'guest_name',
       'payment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(order_items::class);
    }

    public function payment()
    {
        return $this->belongsTo(PaymentModel::class, 'payment_id');
    }
   
}
