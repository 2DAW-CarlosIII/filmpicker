<?php

namespace App\Http\Controllers;

use App\Services\ApiConsumer;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ApiConsumer $client)
    {
        $films = $client->trending();
        return view('home', ['films' => $films]);
    }
}
