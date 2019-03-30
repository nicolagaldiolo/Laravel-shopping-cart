<?php

namespace App\Http\Controllers;

use App\Book;
use App\Facades\CartClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
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
        $isbn = $request->get('isbn', '');
        $qta = (int) $request->get('qta', 0);
        $book = Book::where('isbn', $isbn)->firstOrFail();

        CartClass::add($isbn, $book->title, $book->price, $qta, ['version' => 'paper']);

        return redirect()->route('categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, Book $cart)
    {
        //CartClass::update($cart->isbn, ['qta' => $request->get('qta'), 'price' => 99, 'options' => ['aaa' => 'bbbb']]);
        CartClass::update($cart->isbn, $request->get('qta'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        CartClass::remove($id);
        return redirect()->back();
    }

    public function checkout()
    {
        $addresses = Auth::user()->addresses()->get();
        return view('cart.checkout', compact('addresses'));
    }
}
