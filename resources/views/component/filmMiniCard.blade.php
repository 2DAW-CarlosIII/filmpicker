<div class="col-3 col-lg-2">
    <div class="filmMiniCard card bg-dark text-white">
        <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$filmMiniCard->poster_path}}" alt="Card image">
        <div class="card-img-overlay">
            <div class="text-container text-center">
                <a href="{{route('item',[$filmMiniCard->media_type,$filmMiniCard->id])}}">
                    <h5 class="card-title">{{$filmMiniCard->title ?? $filmMiniCard->name}}</h5>
                </a>
            </div>
        </div>
    </div>
</div>
