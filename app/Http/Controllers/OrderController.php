<?php

namespace App\Http\Controllers;

use App\Facades\CartClass;
use App\Order;
use App\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Auth::user()->orders;

        return view('orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = DB::transaction(function() use($request){

            $cart = CartClass::content();

            $ship_address = Auth::user()->addresses()->find($request->get('ship_address')) ?? Auth::user()->addresses()->first();
            $billing_address = Auth::user()->addresses()->find($request->get('billing_address')) ?? Auth::user()->addresses()->first();

            $order = Auth::user()->orders()->create([
                'amount' => $cart->pluck('total_row')->sum(),
                'date' => Carbon::now(),
                'ship_address' => $ship_address,
                'billing_address' => $billing_address,
                'order_status' => 'PENDING'
            ]);

            $cart->each(function($item, $key) use($order){
                $book = Book::where('isbn', $key)->firstOrFail();
                $order->items()->create([
                    'isbn' => $book->isbn,
                    'item_title' => $book->title,
                    'item_description' => $book->description,
                    'item_price' => $book->price,
                    'quantity' => $item['qta']
                ]);
            });

            CartClass::destroy();
            return $order;

        });

        if($order){
            $order->load('items');
            return redirect()->route('orders.show', $order);
        }else{
            return redirect()->route('cart.checkout')->with('status', "Qualcosa è andato storto, riprovare");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
