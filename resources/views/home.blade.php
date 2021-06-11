@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-4">
                <h3>
                    <a href="{{route('trending')}}">Trending </a>
                </h3>
                <div class="mini-card-container">
                    @foreach ($films->results as $film)
                    @include('component.filmCard')
                    @endforeach
                </div>
            </div>

            @auth
            @if (isset($favoritas) && count($favoritas)>0)
            <div class="mb-4">
                <h3>
                    <a href="{{route('favoritas')}}">Favoritas </a>
                </h3>
                <div class="mini-card-container">
                    @foreach ($favoritas as $film)
                    @include('component.filmCard')
                    @endforeach
                </div>
            </div>
            @endif

            @if (isset($por_ver) && count($por_ver)>0)
            <div class="mb-4">
                <h3>
                    <a href="{{route('por_ver')}}">Por ver</a>
                </h3>
                <div class="mini-card-container">
                    @foreach ($por_ver as $film)
                    @include('component.filmCard')
                    @endforeach
                </div>
            </div>
            @endif
            @endauth
        </div>
    </div>
</div>
@endsection
