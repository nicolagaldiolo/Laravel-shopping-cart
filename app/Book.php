<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $guarded = [];

    public function getRouteKeyName() {
        return 'isbn';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
