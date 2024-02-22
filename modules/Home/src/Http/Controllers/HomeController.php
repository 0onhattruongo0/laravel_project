<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('home::home');
    }

    public function course()
    {
        return view('home::course');
    }

    public function payment()
    {
        return view('home::payment');
    }
}
