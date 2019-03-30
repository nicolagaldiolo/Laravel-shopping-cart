<?php
// app/Tools/CartClass.php
namespace App\Tools;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartClass
{

    protected $cart = [];
    protected $sessionVar = 'cart';

    public function __construct($sessionVar = '')
    {
        if(!empty($sessionVar))
            $this->sessionVar = $sessionVar;
        $this->cart = Session::get($this->sessionVar, []);
    }

    public function content() : Collection
    {
        return collect($this->cart);
    }

    public function add($id, $name = '', $price = 0, $quantity = 1, $options = [])
    {
        $qta = (int) array_key_exists($id, $this->cart) ? $this->cart[$id]['qta'] + $quantity : $quantity;
        $this->cart[$id]['name'] = $name;
        $this->cart[$id]['qta'] = $qta;
        $this->cart[$id]['price'] = $price;
        $this->cart[$id]['total_row'] = ($price * $qta);
        if(!empty($options))
            $this->cart[$id]['options'] = $options;

        Session::put($this->sessionVar, $this->cart);
    }

    public function update($id, $params)
    {
        if(array_key_exists($id, $this->cart)) {
            if (is_array($params)) {
                foreach ($params as $key=>$value){
                    if(array_key_exists($key, $this->cart[$id])){
                        $this->cart[$id][$key] = $value;
                    }
                }

            } else {
                $this->cart[$id]['qta'] = $params;
                $this->cart[$id]['total_row'] = ($this->cart[$id]['price'] * $params);
            }

            Session::put($this->sessionVar, $this->cart);
        }
    }

    public function remove($id) : void
    {
        logger($this->cart);
        if(array_key_exists($id, $this->cart)){
            unset($this->cart[$id]);
            Session::put($this->sessionVar, $this->cart);
        }
    }

    public function destroy()
    {
        $this->cart = [];
        Session::forget($this->sessionVar);
    }

    public function total()
    {
        return collect($this->cart)->pluck('total_row')->sum();
    }

    public function quantity()
    {
        return collect($this->cart)->pluck('qta')->sum();
    }
}
