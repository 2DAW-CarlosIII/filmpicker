@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mini-card-grid">
        <div class="row">
            @foreach ($films->results ?? $films as $film)
            <div class="col-3 mb-4">
                @include('component.filmCard')
            </div>
            @endforeach
        </div>
    </div>

    @include('component.pageNavigation')

</div>
@endsection
