@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card p-2 d-inline-block m-auto">
            @if($errors->any())
            <p class="bg-danger text-center text-white p-1">{{$errors->first()}}</p>
            @endif
            <form action="{{route('unirseASala')}}" method="POST">
                @csrf
                <div class="form-group m-2">
                    <label for="salaId">Código de la sala: </label>
                    <input type="text" name="salaId" id="salaId" placeholder="HQV7GB" pattern="\w{6}" maxlength="6"
                        size="6" title="Código de 6 letras y números" @isset($salaId) value="{{$salaId}}" readonly
                        @endisset>
                </div>
                <div class="form-check m-2">
                    <input class="form-check-input" type="checkbox" name="por_ver" id="por_ver">
                    <label class="form-check-label" for="por_ver">Añadir tu lista de películas por ver</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
