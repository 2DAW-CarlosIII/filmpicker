@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mini-card-grid">
        <div class="row">
            @foreach ($films->results as $film)
            @if ($film->media_type != 'person')
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                @include('component.filmCard')
            </div>
            @endif
            @endforeach
        </div>
    </div>

    @include('component.pageNavigation')

</div>
@endsection
