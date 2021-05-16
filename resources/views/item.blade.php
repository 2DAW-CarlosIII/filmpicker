@extends('layouts.app')

@section('content')
<div class="container-fluid itemPage">
    <div class="row justify-content-center">
        <img class="header" src="https://image.tmdb.org/t/p/original/{{$item->backdrop_path}}" alt="header">

    </div>
</div>

<pre>{{print_r($item)}}</pre>
@endsection
