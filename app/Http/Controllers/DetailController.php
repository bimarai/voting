<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Detail;

class DetailController extends Controller
{
    public function index()
    {
        // hanya untuk mengembalikan tampilan pengguna
        return view('kandidat.detail');
    }

    // Menampilkan detail kandidat berdasarkan ID
    public function show(String $id): view
    {
        // meng ambil data id 
        $dtDetail = Detail::findOrFail($id);
        $name = 'Halaman detail | admin';

        return view('kandidat.detail', compact('dtDetail', 'name'));
    }
}
