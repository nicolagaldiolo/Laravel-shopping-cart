<?php

// app/Facades/CartClass.php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CartClass extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CartClass';
    }
}