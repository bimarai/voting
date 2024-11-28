<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    public function index()
    {
        $dtHome = Home::All();
        $name = 'Vote App';
        return view('Home', compact('dtHome', 'name'));
    }
}
