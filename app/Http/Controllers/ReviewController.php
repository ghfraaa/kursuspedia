<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        
        // PERBAIKAN: Hanya status 'diterima' yang boleh memberikan review
        $sudah_terdaftar = Transaction::where('user_id', $user->id)
            ->where('kursus_id', $id)
            ->where('status', 'diterima') // HANYA status diterima
            ->exists();

        // Cek apakah user bukan admin dan sudah terdaftar dengan status diterima
        if (!$sudah_terdaftar || $user->role === 'admin') {
            return redirect()->back()->with('error', 'Anda tidak dapat memberikan review. Pastikan pembayaran Anda sudah diterima.');
        }

        // Cek apakah user sudah memberikan review untuk kursus ini
        $existing_review = Review::where('user_id', $user->id)
            ->where('kursus_id', $id)
            ->first();

        if ($existing_review) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk kursus ini.');
        }

        Review::create([
            'user_id' => $user->id,
            'kursus_id' => $id,
            'rating' => $request->input('rating'),
            'komentar' => $request->input('komentar'), 
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
    }
}