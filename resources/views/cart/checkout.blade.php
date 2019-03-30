@extends('layouts.app')
@section('content')
    <div class="container">

        @if(\App\Facades\CartClass::content()->isNotEmpty())
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
                @foreach(\App\Facades\CartClass::content() as $item)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="http://placehold.it/70x70" alt="..." class="img-fluid"/>
                                </div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{$item['name']}}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">&euro; {{$item['price']}}</td>
                        <td data-th="Quantity">{{$item['qta']}}</td>
                        <td data-th="Subtotal" class="text-center">&euro; {{$item['total_row']}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total &euro; {{\App\Facades\CartClass::total()}}</strong></td>
                </tr>
                </tfoot>

            </table>
            <hr>
            <form action="{{route('orders.store')}}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col">
                        <h4>Indirizzo di consegna</h4>
                        @foreach($addresses as $address)
                            <hr>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="ship_address" value="{{$address->id}}">
                                    <strong>{{$address->name}}</strong><br>
                                    {{$address->address}}<br>
                                    {{$address->city}}, {{$address->state}}, {{$address->zip}}, {{$address->country}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col">
                        <h4>Indirizzo di fatturazione</h4>
                        @foreach($addresses as $address)
                            <hr>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="billing_address" value="{{$address->id}}">
                                    <strong>{{$address->name}}</strong><br>
                                    {{$address->address}}<br>
                                    {{$address->city}}, {{$address->state}}, {{$address->zip}}, {{$address->country}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-block">Completa ordine <i class="fa fa-angle-right"></i></button>
            </form>

            <hr>
        @else
            <h2>Il carrello è vuoto</h2>
        @endif
    </div>
@stop