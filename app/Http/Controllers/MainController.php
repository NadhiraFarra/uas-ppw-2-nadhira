<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;

class MainController extends Controller
{
    public function index()
    {
        $pekerjaan = Pekerjaan::withCount('pegawai')->get();

        $labels = $pekerjaan->pluck('nama');
        $data = $pekerjaan->pluck('pegawai_count');

        return view('beranda', compact('labels','data'));
    }
}
