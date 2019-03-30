@extends('layouts.app')
@section('content')
    <div class="container">

        @if($order)
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="nomargin">{{$item->item_title}}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">&euro; {{$item->item_price}}</td>
                        <td data-th="Quantity">{{$item->quantity}}</td>
                        <td data-th="Subtotal" class="text-center">&euro; {{$item->item_price * $item->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">
                        <strong>Status:</strong> {{$order->order_status}}<br>
                        <strong>Total:</strong> &euro; {{$order->amount}}<br>
                        <strong>Shipping address:</strong> ({{$order->ship_address['name']}}) - {{$order->ship_address['address']}} {{$order->ship_address['city']}} {{$order->ship_address['state']}}<br>
                        <strong>Billing address:</strong> ({{$order->billing_address['name']}}) - {{$order->billing_address['address']}} {{$order->billing_address['city']}} {{$order->billing_address['state']}}<br>

                        <hr>
                        @if($order->order_status == 'PENDING')
                            <a href="" class="btn btn-primary btn-lg"><i class="fab fa-paypal"></i> Paga ordine</a>
                        @endif
                    </td>
                </tr>
                </tfoot>

            </table>

        @else
            <h2>Il carrello è vuoto</h2>
        @endif
    </div>
@stop