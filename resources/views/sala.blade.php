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
        <div class="col-12 position-relative">
            @php
            $film = $sala->pool->list[$user->posicion_sala ?? 0];
            if (!isset($film->poster_path)) {   //Comprobar si es la versión 'light'
            $film = $cliente->getItem($film->media_type, $film->id);
            }
            @endphp

            <div class="card main-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{route('item',[$film->media_type,$film->id])}}">
                            {{$film->title ?? $film->name}}
                        </a>
                    </h3>
                </div>
                <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}" alt="Card image">
            </div>

        </div>
    </div>
    <pre>
        {{print_r($sala->pool->list)}}
    </pre>
</div>
@endsection
