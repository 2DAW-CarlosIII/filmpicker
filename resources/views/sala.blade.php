@extends('layouts.app')

@section('content')
<div class="container sala">
    <div class="row">
        <div class="col-12 position-relative">
            <h2 class="text-center">Sala {{__(Auth::user()->sala_id)}}</h2>
            <form action="{{route('salirSala')}}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Salir</button>
            </form>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            Card header
        </div>
        aougfhyuiaqwr
    </div>
</div>
@endsection
