@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mini-card-grid">
        <div class="row">
            @foreach ($films->results as $film)
            <div class="col-3 mb-4">
                <div class="card bg-dark text-white">
                    <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}" alt="Card image">
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{$film->title ?? $film->name}}</h5>
                        <p class="card-text">Last updated 3 mins ago</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
