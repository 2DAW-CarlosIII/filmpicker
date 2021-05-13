@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <a href="trending"><h3>Trending</h3></a>
                <div class="mini-card-container">
                    @foreach ($films->results as $film)
                    <div class="card bg-dark text-white mini-card">
                        <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}"
                            alt="Card image">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{$film->title ?? $film->name}}</h5>
                            <p class="card-text">Last updated 3 mins ago</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                @auth
                <h3>Favoritas</h3>
                <div class="mini-card-container">
                    @foreach ($films->results as $film)
                    <div class="card bg-dark text-white mini-card">
                        <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}"
                            alt="Card image">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{$film->title ?? $film->name}}</h5>
                            <p class="card-text">Last updated 3 mins ago</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endauth

            </div>
        </div>
    </div>
</div>
@endsection
