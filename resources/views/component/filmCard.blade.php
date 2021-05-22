<div class="filmCard card bg-dark text-white">
    <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}" alt="Card image">
    <div class="card-img-overlay">
        <div class="text-container">
            <a href="{{route('item',[$film->media_type,$film->id])}}">
                <h5 class="card-title">{{$film->title ?? $film->name}}</h5>
            </a>
            <p class="card-text">{{$film->overview}}</p>
        </div>
        <div class="d-flex justify-content-between">
            <div class="align-self-center order-1">{{$film->vote_average*10}}%</div>
            <a class="align-self-center order-3" href="{{route('item',[$film->media_type,$film->id])}}">Ver más &gt;</a>

            @auth
            <fav-button-component :media_type="'{{$film->media_type}}'" :id="{{$film->id}}" class="order-2" />
            @endauth
        </div>
    </div>
</div>
