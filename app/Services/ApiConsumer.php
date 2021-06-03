<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ApiConsumer
{
    private $url;
    private $key;

    public function __construct()
    {
        $this->url = 'https://' . Config::get('constants.API_HOST');
        $this->key = ['api_key' => env('TMDBAPI_KEY')];
    }

    /**
     * Función privada que se encarga de hacer la petición get
     */
    private function getResponse(string $uri = null, array $params = [])
    {
        $params += $this->key;
        $response = Http::get($this->url . $uri . '?', $params);
        return json_decode($response);
    }

    /**
     * Recupera las peliculas más populares de TMDB con una paginacion de 20 elementos
     *
     */
    public function trending($page = 1)
    {
        $uri = 'trending/all/week';
        return $this->getResponse($uri, array('page' => $page));
    }

    /**
     * Recupera información de un item específico (película o programa de tv)
     *
     */
    public function getItem($mediaType, $id)
    {
        $uri = $mediaType . '/' . $id;
        $item = $this->getResponse($uri);
        $item->media_type = $mediaType;
        return $item;
    }

    /**
     * Recupera los resultados de la búsqueda de una cadena
     *
     */
    public function search($cadena, $page = 1)
    {
        $params = array('query' => $cadena, 'page' => $page);
        return $this->getResponse('search/multi', $params);
    }
}
