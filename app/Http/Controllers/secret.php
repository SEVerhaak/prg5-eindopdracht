<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class secret extends Controller
{
    public function secret(){
        /*
        $albumController = new Album;
        $albumController->name = 'test';
        $albumController->artist = 'test-artist';
        $albumController->year = '2003';
        */
        $albums = Album::all();

        // $secret = ['Paramazan', 'Tabby', 'Tapir'];
        return view('logged-in-test', compact('albums'));
    }
}
