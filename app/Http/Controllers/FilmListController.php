<?php

namespace App\Http\Controllers;

use App\Services\ApiConsumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class FilmListcontroller extends Controller
{

    public function trending($page = 1, ApiConsumer $client)
    {
        $films = $client->trending($page);
        return view('filmList', ['films' => $films]);
    }

    public function favoritas($page = 1, ApiConsumer $client)
    {
        $favoritas = Auth::user()->favoritas;
        $films = new stdClass();
        $films->results = [];
        for ($i = ($page - 1) * 20; $i < 20 * $page; $i++) {
            if (isset($favoritas[$i])) {
                $film = $client->getItem($favoritas[$i]->media_type, $favoritas[$i]->id);
                $film->media_type = $favoritas[$i]->media_type;
                array_push($films->results, $film);
            } else {
                break;
            }
        }
        $films->page = $page;
        $films->total_pages = ceil(count($favoritas) / 20);
        return view('filmList', ['films' => $films]);
    }

    public function por_ver($page = 1, ApiConsumer $client)
    {
        $por_ver = Auth::user()->por_ver;
        $films = new stdClass();
        $films->results = [];
        for ($i = ($page - 1) * 20; $i < 20 * $page; $i++) {
            if (isset($por_ver[$i])) {
                $film = $client->getItem($por_ver[$i]->media_type, $por_ver[$i]->id);
                $film->media_type = $por_ver[$i]->media_type;
                array_push($films->results, $film);
            } else {
                break;
            }
        }
        $films->page = $page;
        $films->total_pages = ceil(count($por_ver) / 20);
        return view('filmList', ['films' => $films]);
    }

    public function itemPage($mediaType, $id, ApiConsumer $client)
    {
        $item = $client->getItem($mediaType, $id);
        return view('item', ['item' => $item]);
    }

    public function search(Request $request, $page = 1, ApiConsumer $client)
    {
        $films = $client->search($request->input('query'), $page);
        return view('filmList', ['films' => $films, 'query' => $request->input('query')]);
    }
}
