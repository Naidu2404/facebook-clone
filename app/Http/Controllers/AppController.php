<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    //we define the index route of our app here
    public function index()
    {
        return view('home');
    }
}