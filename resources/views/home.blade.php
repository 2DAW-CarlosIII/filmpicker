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
            @if (isset(Auth::user()->favoritas) && count(Auth::user()->favoritas)>0)
            <div class="mb-4">
                <h3>
                    <a href="{{route('favoritas')}}">Favoritas </a>
                </h3>
                <div class="mini-card-container">
                    @foreach (Auth::user()->favoritas as $fav)
                    @php
                    $film=$cliente->getItem($fav->media_type,$fav->id);
                    $film->media_type = $fav->media_type
                    @endphp
                    @include('component.filmCard')
                    @endforeach
                </div>
            </div>
            @endif

            @if (isset(Auth::user()->por_ver) && count(Auth::user()->por_ver)>0)
            <div class="mb-4">
                <h3>
                    <a href="{{route('por_ver')}}">Por ver</a>
                </h3>
                <div class="mini-card-container">
                    @foreach (Auth::user()->por_ver as $fav)
                    @php
                    $film=$cliente->getItem($fav->media_type,$fav->id);
                    $film->media_type = $fav->media_type
                    @endphp
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
