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
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Facades\CartClass::content() as $key=>$item)
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
                            <td data-th="Quantity">
                                <form class="d-flex" method="POST" action="{{route('cart.update', $key)}}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="qta" class="form-control text-center" value="{{$item['qta']}}" min="1" max="99" style="min-width: 70px;">
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-sync-alt"></i></button>
                                </form>
                            </td>
                            <td data-th="Subtotal" class="text-center">&euro; {{$item['total_row']}}</td>
                            <td class="actions" data-th="">
                                <div class="d-flex">
                                    <form method="POST" action="{{route('cart.destroy', $key)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="{{route('categories.index')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong>Total &euro; {{\App\Facades\CartClass::total()}}</strong></td>
                        <td><a href="{{route('cart.checkout')}}" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                    </tr>
                </tfoot>
            </table>
        @else
            <h2>Il carrello è vuoto</h2>
        @endif
    </div>
@stop