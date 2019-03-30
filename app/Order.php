<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $dates = [
        'date'
    ];
    protected $guarded = [];

    protected $casts = [
        'ship_address' => 'array',
        'billing_address' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
