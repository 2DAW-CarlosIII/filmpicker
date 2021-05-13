<?php

namespace App\Http\Controllers;

class FilmListcontroller extends Controller{

    public function trending(){
        $films = ApiConsumerController::trending() ;
        return view('filmList',['films'=>$films]);
    }

}
