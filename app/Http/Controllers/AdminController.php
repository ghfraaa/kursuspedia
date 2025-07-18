<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kursus;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data statistik untuk dashboard
        $totalKursus = Kursus::count();
        $totalUser = User::count();
        $totalSiswaTerdaftar = Kursus::sum('siswa_terdaftar');
        $totalPendapatan = Kursus::sum(DB::raw('harga * siswa_terdaftar')); // Simulasi pendapatan
        
        // Ambil kursus populer
        $kursusPopuler = Kursus::orderBy('siswa_terdaftar', 'desc')->take(5)->get();
        
        // Ambil user terbaru
        $userTerbaru = User::where('role', 'user')->latest()->take(5)->get();
        
        // Ambil semua kursus untuk tabel
        $semuaKursus = Kursus::latest()->take(10)->get();
        
        // Data untuk chart (simulasi data bulanan)
        $monthlyData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            'data' => [12, 19, 15, 25, 22, 30, 28]
        ];
        
        return view('admin.dashboard', compact(
            'totalKursus', 
            'totalUser', 
            'totalSiswaTerdaftar', 
            'totalPendapatan',
            'kursusPopuler',
            'userTerbaru',
            'semuaKursus',
            'monthlyData'
        ));
    }
}
