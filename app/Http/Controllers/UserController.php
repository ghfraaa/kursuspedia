<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction; // Corrected: Use singular 'Transaction'
use App\Models\Kursus;

class UserController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            // Jika tidak login, arahkan ke halaman login atau home
            return redirect()->route('login'); // Atau return view('home.index');
        }

        // Ambil transaksi yang dimiliki oleh user yang sedang login
        // Dengan eager loading 'kursus' untuk mendapatkan detail kursus
        $transactions = Auth::user()->transactions()->with('kursus')->get();

        // Anda juga bisa mengambil semua kursus jika diperlukan di dashboard
        $kursuses = Kursus::all();

        return view('dashboard', compact('transactions', 'kursuses'));
    }
}