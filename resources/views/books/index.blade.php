@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://via.placeholder.com/800x600" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <small>
                                <strong>ISBN: </strong>{{$book->isbn}}<br>
                                <strong>Author: </strong>{{$book->author}}
                            </small>
                            <h3 class="mt-2">&euro; {{$book->price}}</h3>
                            <a href="{{route('book', ['category' => $category, 'book' => $book])}}" class="btn btn-primary">Scopri</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop