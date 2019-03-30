@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <img src="https://via.placeholder.com/800x600" class="card-img" alt="...">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">{{$book->title}}</h5>
                                    <p class="card-text">{{$book->description}}</p>
                                    <h3>&euro; {{$book->price}}</h3>
                                    <small>
                                        <strong>ISBN: </strong>{{$book->isbn}}<br>
                                        <strong>Author: </strong>{{$book->author}}
                                    </small>
                                    <hr>

                                    <form method="POST" action="{{route('cart.store')}}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Quantità</label>
                                                <input type="number" name="qta" class="form-control mb-2" placeholder="Quantità" value="1" min="1" max="99" required>
                                                <input type="hidden" name="isbn" value="{{$book->isbn}}">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary mb-2">Aggiungi al carrello</button>
                                            </div>
                                        </div>
                                    </form>

                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop