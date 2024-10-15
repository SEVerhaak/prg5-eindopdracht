<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class secret extends Controller
{
    public function secret(){
        $secret = ['Paramazan', 'Tabby', 'Tapir'];
        return view('logged-in-test', compact('secret'));
    }
}
