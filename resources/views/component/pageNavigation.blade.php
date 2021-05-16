<div class="d-flex justify-content-center">
    @php
    $rutaActual= Request::route()->getName();
    if (str_contains($rutaActual,'trending')) {
    $ruta='trending';
    }elseif (str_contains($rutaActual,'favoritas')) {
    $ruta='favoritas';
    }elseif (str_contains($rutaActual,'por_ver')) {
    $ruta='por_ver';
    }
    @endphp

    @if($films->page > 1)
    <a class="btn btn-primary mx-2" href="{{route($ruta,[$films->page-1])}}" role="button">&lt;</a>
    @endif
    @if ($films->total_pages>1)
    <a class="btn btn-primary mx-2" href="{{route($ruta,[$films->page+1])}}" role="button">&gt;</a>
    @endif
</div>
