<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{

    public function getRouteKeyName() {
        return 'slug';
    }

    public function setNameAttribute($name) {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    public function books(){
        return $this->hasMany(Book::class);
    }
}
