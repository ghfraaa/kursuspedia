<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Kursus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Review;
use App\Models\User;

class KursusController extends Controller
{
    public function index()
    {
        $kursuses = Kursus::all(); // ambil semua kursus
        
        // Ambil review terbaru untuk testimoni section
        $testimoni_reviews = Review::with(['user', 'kursus'])
            ->latest()
            ->limit(6) // Ambil 6 review terbaru untuk 2 slide (3 per slide)
            ->get();

        $averageRating = Review::avg('rating');
        $formattedAverageRating = number_format($averageRating ?? 0, 1); 
        $maxRating = 5; 
        $satisfactionPercentage = ($averageRating / $maxRating) * 100;
        
        $satisfactionPercentage = round($satisfactionPercentage);
        
        return view('home.index', compact('kursuses', 'testimoni_reviews', 'averageRating', 'formattedAverageRating', 'satisfactionPercentage'));
    }

    public function show($id)
    {
        $kursus = Kursus::findOrFail($id);
        $user = auth()->user();

        $sudah_terdaftar = false;
        $sudah_memberi_review = false;
        $review_user = null;
        $belum_beli = true; // Default: user belum beli

        if ($user && $user->role !== 'admin') {
            // Cek apakah user sudah terdaftar dengan status 'diterima'
            $sudah_terdaftar = Transaction::where('user_id', $user->id)
                ->where('kursus_id', $kursus->id)
                ->where('status', 'diterima') // HANYA status diterima
                ->exists();

            // Cek apakah user pernah mendaftar kursus ini (dengan status apapun)
            $pernah_mendaftar = Transaction::where('user_id', $user->id)
                ->where('kursus_id', $kursus->id)
                ->exists();

            // Jika user pernah mendaftar tapi belum diterima, maka belum_beli = false
            // Jika user belum pernah mendaftar sama sekali, maka belum_beli = true
            $belum_beli = !$pernah_mendaftar;

            $review_user = Review::where('user_id', $user->id)
                ->where('kursus_id', $kursus->id)
                ->first();

            $sudah_memberi_review = $review_user !== null;
        }

        $all_reviews = $kursus->reviews()->with('user')->latest()->get();

        return view('home.partials.show', compact('kursus', 'sudah_terdaftar', 'sudah_memberi_review', 'review_user', 'all_reviews', 'belum_beli'));
    }

    public function enroll(Request $request, Kursus $kursus)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mendaftar kursus.');
        }

        // Cek apakah user sudah terdaftar di kursus ini (opsional, bisa ditambahkan)
        $existingTransaction = Transaction::where('user_id', Auth::id())
            ->where('kursus_id', $kursus->id)
            ->first();

        if ($existingTransaction) {
            return redirect()->back()->with('info', 'Anda sudah mendaftar kursus ini. Status Transaksi: ' . $existingTransaction->status);
        }

        // Buat Transaction baru dengan status 'belum_dibayar'
        Transaction::create([
            'user_id' => Auth::id(),
            'kursus_id' => $kursus->id,
            'amount' => $kursus->harga,
            'status' => 'belum_dibayar',
            // payment_proof akan diisi saat user upload bukti pembayaran
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar kursus! Silakan lakukan pembayaran.');
    }

    /**
     * Show the form to upload payment proof.
     * Method ini masih dipertahankan untuk kompatibilitas, tapi tidak digunakan lagi
     */
    public function showUploadPaymentProofForm(Transaction $transaction)
    {
        // Pastikan Transaction milik user yang sedang login dan statusnya 'belum_dibayar'
        if ($transaction->user_id !== Auth::id() || $transaction->status !== 'belum_dibayar') {
            return redirect()->back()->with('error', 'Transaksi tidak valid untuk upload bukti pembayaran.');
        }
        return view('home.partials.upload-bukti', compact('transaction'));
    }

    /**
     * Handle the upload of payment proof.
     * Updated untuk menangani request via modal/AJAX
     */
    public function uploadPaymentProof(Request $request, Transaction $transaction)
    {
        // Pastikan Transaction milik user yang sedang login dan statusnya 'belum_dibayar'
        if ($transaction->user_id !== Auth::id() || $transaction->status !== 'belum_dibayar') {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak valid untuk upload bukti pembayaran.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Transaksi tidak valid untuk upload bukti pembayaran.');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('payment_proof')) {
            // Hapus file lama jika ada
            if ($transaction->payment_proof) {
                Storage::disk('public')->delete($transaction->payment_proof);
            }

            // Menyimpan file di direktori 'payment_proofs' di dalam disk 'public'
            // dan akan mengembalikan path relatif seperti 'payment_proofs/namafileunik.jpg'
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            $transaction->update([
                'payment_proof' => $path, // Menyimpan path relatif ini ke database
                'status' => 'pending', // Ubah status menjadi pending setelah upload bukti
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.'
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Bukti pembayaran gagal diunggah. Silahkan coba lagi'
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Bukti pembayaran gagal diunggah. Silahkan coba lagi');
    }
}