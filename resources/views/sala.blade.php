@extends('layouts.app')

@section('content')
<div class="container sala">
    <div class="row">
        <div class="col-12 position-relative">
            <h2 class="text-center">Sala {{__(Auth::user()->sala_id)}}</h2>
            <form action="{{route('salirSala')}}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary salida">Salir</button>
            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            @php
            $film = $sala->pool->list[$user->posicion_sala ?? 0];
            if (!isset($film->poster_path)) { //Comprobar si es la versión 'light' de $film
            $film = $cliente->getItem($film->media_type, $film->id);
            }
            @endphp

            <div class="card main-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{route('item',[$film->media_type,$film->id])}}" class="pe-auto">
                            {{$film->title ?? $film->name}}
                        </a>
                    </h3>
                </div>
                <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}" alt="Card image">
                <div class="card-img-overlay d-flex justify-content-around align-items-end pe-none">
                    <div class="d-inline-block pe-auto">
                        <accept-button :film='@json($film)' />
                    </div>
                    <div class="d-inline-block pe-auto">
                        <later-button :media_type="'{{$film->media_type}}'" :id="{{$film->id}}" />
                    </div>
                    <div class="d-inline-block pe-auto">
                        <reject-button :film='@json($film)' />
                    </div>
                </div>
            </div>
            <div class="card main-card">
                <div class="card-body">
                    <p class="card-text">
                        {{$film->overview}}
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
            <h3>Matchs</h3>
        </div>
    </div>
    <div class="row flex-row flex-nowrap overflow-auto">
            @foreach ($sala->matchs as $filmMiniCard)
            @include('component.filmMiniCard')
            @endforeach
    </div>
</div>
@endsection
