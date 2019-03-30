@extends('layouts.app')

@section('content')



    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="https://via.placeholder.com/800x600" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{$category->name}}</h5>
                                <p class="card-text">{{$category->books_count}} libri</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('books', $category)}}" class="btn btn-primary my-2">Vedi libri</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop