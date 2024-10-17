<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class secret extends Controller
{
    public function secret(){
        /*
        $album = new Album;
        $album->name = 'test';
        $album->artist = 'test-artist';
        $album->year = '2003';
        */
        $albums = Album::all();

        // $secret = ['Paramazan', 'Tabby', 'Tapir'];
        return view('logged-in-test', compact('albums'));
    }
}
