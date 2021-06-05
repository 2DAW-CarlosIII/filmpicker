@extends('layouts.app')

@section('content')
<div class="container-fluid itemPage">
    <div class="row justify-content-center bg-dark">
        <img class="header position-absolute" src="https://image.tmdb.org/t/p/original/{{$item->backdrop_path}}" alt="header">

        <div class="card bg-transparent text-white w-100">
            <div class="card-text">
                <div class="container d-flex">
                    <div class="row pt-3 pb-3">
                        <div class="d-none d-md-block col-3">
                            <div class="card">
                                <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$item->poster_path}}"
                                    alt="Card image">
                            </div>
                        </div>
                        <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                            <div class="row">
                                <div class="col-12">
                                    <h1><a href="{{$item->homepage}}">{{$item->name ?? $item->title}}</a></h1>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-10 col-lg-7 m-auto d-flex justify-content-around align-items-center">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="pr-2 score-text">User <br> score:</div>
                                        <div class="score">{{$item->vote_average*10}}%</div>
                                    </div>
                                    @auth
                                    <div>
                                        <later-button :media_type="'{{$item->media_type}}'" :id="{{$item->id}}" />
                                    </div>
                                    <div>
                                        <fav-button-component :media_type="'{{$item->media_type}}'"
                                            :id="{{$item->id}}" />
                                    </div>
                                    @endauth
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h3>Overview</h3>
                                    <p class="card-text">{{$item->overview}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
