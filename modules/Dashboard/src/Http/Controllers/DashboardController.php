<?php

namespace Modules\Dashboard\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index(){
        $page_title = 'Trang tổng quan';
        return view('dashboard::index',compact('page_title'));
    }
}