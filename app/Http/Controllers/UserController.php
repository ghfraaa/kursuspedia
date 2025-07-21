<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Kursus;

class UserController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil transaksi yang dimiliki oleh user yang sedang login
        $transactions = Auth::user()->transactions()->with('kursus')->get();

        // Hitung statistik untuk dashboard cards
        $totalPembelian = $transactions->count();
        
        // Transaksi yang diterima (status: paid/completed/success)
        $transaksiDiterima = $transactions->whereIn('status', 'diterima')->count();
        
        // Transaksi yang belum dibayar (status: pending/unpaid)
        $transaksiBelumBayar = $transactions->whereIn('status', 'belum_dibayar')->count();
        
        // Transaksi menunggu konfirmasi (status: waiting_confirmation)
        $menungguKonfirmasi = $transactions->where('status', 'pending')->count();

        // Ambil semua kursus jika diperlukan
        $kursuses = Kursus::all();

        return view('dashboard', compact(
            'transactions', 
            'kursuses', 
            'totalPembelian',
            'transaksiDiterima',
            'transaksiBelumBayar',
            'menungguKonfirmasi'
        ));
    }
}