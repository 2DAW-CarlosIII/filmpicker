<div class="filmCard card bg-dark text-white">
    <img class="card-img" src="https://image.tmdb.org/t/p/w500{{$film->poster_path}}" alt="Card image">
    <div class="card-img-overlay">
<div class="text-container">
        <h5 class="card-title">{{$film->title ?? $film->name}}</h5>
        <p class="card-text">{{$film->overview}}</p>
</div>
        <div class="d-flex justify-content-between">
            <div class="align-self-center">{{$film->vote_average*10}}%</div>
            @auth
            <span class="text-center">&#9733;</span>
            @endauth
            <a class="align-self-center" href="{{route('item',[$film->media_type,$film->id])}}">Ver más &gt;</a>
        </div>
    </div>
</div>
