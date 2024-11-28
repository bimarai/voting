<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $name = 'About us';
        return view('pemilih/about', compact('name'));
    }
}
