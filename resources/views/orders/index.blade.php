@extends('layouts.app')
@section('content')
    <div class="container">

        @if($orders->isNotEmpty())
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Ship address</th>
                    <th>Ship address</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $item)
                    <tr>
                        <td>{{$item->date}}</td>
                        <td>&euro; {{$item->amount}}</td>
                        <td>{{$item->order_status}}</td>
                        <td>{{--$item->ship_address->address--}}</td>
                        <td>{{--$item->ship_address--}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('orders.show', $item) }}"><i class="fas fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h2>Non ci sono ordini</h2>
        @endif
    </div>
@stop