<?php

// app/Providers/ToolsServiceProvider.php
namespace App\Providers;

use App\Tools\CartClass;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('CartClass', function(){
            return new CartClass('cart');
        });
    }
}
