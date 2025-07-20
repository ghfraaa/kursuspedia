<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori dari DB
        $kursuses = Kursus::all();    // Ambil semua kursus

        return view('halaman.beranda', compact('kategoris', 'kursuses'));
    }
}
