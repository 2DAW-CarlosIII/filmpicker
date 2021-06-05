<div class="d-flex justify-content-center">
    @php
    $rutaActual= Request::route()->getName();
    if (str_contains($rutaActual,'trending')) {
    $ruta='trending';
    }elseif (str_contains($rutaActual,'favoritas')) {
    $ruta='favoritas';
    }elseif (str_contains($rutaActual,'por_ver')) {
    $ruta='por_ver';
    }else{
    $ruta='search';
    }
    @endphp

    @if($films->page > 1)
    <a class="btn btn-primary mx-2"
        @if (isset($query))
            href="{{route($ruta,[$films->page-1,'query' => $query])}}"
        @else
            href="{{route($ruta,[$films->page-1])}}"
        @endif
    role="button">&lt;</a>
    @endif
    @if ($films->total_pages>1 && $films->page < $films->total_pages)
    <a class="btn btn-primary mx-2"
        @if (isset($query))
            href="{{route($ruta,[$films->page+1,'query' => $query])}}"
        @else
            href="{{route($ruta,[$films->page+1])}}"
        @endif
    role="button">&gt;</a>
    @endif
</div>
