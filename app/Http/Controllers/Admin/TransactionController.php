<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'kursus'])
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('kursus', function($kursusQuery) use ($search) {
                    $kursusQuery->where('nama', 'like', "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transactions = $query->paginate(15);

        return view('admin.transaksi.index', compact('transactions'));
    }

    /**
     * Approve a transaction.
     */
    public function approve(Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            // Update transaction status
            $transaction->update(['status' => 'diterima']);

            // Increment siswa_terdaftar in kursus
            $kursus = $transaction->kursus;
            $kursus->increment('siswa_terdaftar');

            // Check if course is full
            if ($kursus->siswa_terdaftar >= $kursus->jumlah_siswa) {
                // Optionally, you can mark the course as full or handle accordingly
                // For now, we'll just let it exceed the limit
            }

            DB::commit();

            return redirect()->route('admin.transaksi.index')
                ->with('success', 'Transaksi berhasil diterima dan siswa telah terdaftar ke kursus.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Terjadi kesalahan saat menerima transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Reject a transaction.
     */
    public function reject(Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            // If transaction was previously approved, decrease siswa_terdaftar
            if ($transaction->status === 'diterima') {
                $kursus = $transaction->kursus;
                if ($kursus->siswa_terdaftar > 0) {
                    $kursus->decrement('siswa_terdaftar');
                }
            }

            // Update transaction status
            $transaction->update(['status' => 'pending']);

            DB::commit();

            return redirect()->route('admin.transaksi.index')
                ->with('success', 'Transaksi berhasil ditolak.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Terjadi kesalahan saat menolak transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            // If transaction was approved, decrease siswa_terdaftar
            if ($transaction->status === 'diterima') {
                $kursus = $transaction->kursus;
                if ($kursus->siswa_terdaftar > 0) {
                    $kursus->decrement('siswa_terdaftar');
                }
            }

            // Delete payment proof file if exists
            if ($transaction->payment_proof) {
                Storage::delete('public/payment_proofs/' . $transaction->payment_proof);
            }

            // Delete transaction
            $transaction->delete();

            DB::commit();

            return redirect()->route('admin.transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Terjadi kesalahan saat menghapus transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'kursus']);
        
        return view('admin.transaksi.show', compact('transaction'));
    }

    /**
     * Update transaction status in bulk.
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'transaction_ids' => 'required|array',
            'transaction_ids.*' => 'exists:transactions,id',
            'action' => 'required|in:approve,reject,delete'
        ]);

        try {
            DB::beginTransaction();

            $transactions = Transaction::whereIn('id', $request->transaction_ids)->get();
            $successCount = 0;

            foreach ($transactions as $transaction) {
                switch ($request->action) {
                    case 'approve':
                        if ($transaction->status !== 'diterima') {
                            $transaction->update(['status' => 'diterima']);
                            $transaction->kursus->increment('siswa_terdaftar');
                            $successCount++;
                        }
                        break;

                    case 'reject':
                        if ($transaction->status === 'diterima') {
                            $kursus = $transaction->kursus;
                            if ($kursus->siswa_terdaftar > 0) {
                                $kursus->decrement('siswa_terdaftar');
                            }
                        }
                        $transaction->update(['status' => 'ditunda']);
                        $successCount++;
                        break;

                    case 'delete':
                        if ($transaction->status === 'diterima') {
                            $kursus = $transaction->kursus;
                            if ($kursus->siswa_terdaftar > 0) {
                                $kursus->decrement('siswa_terdaftar');
                            }
                        }
                        
                        // Delete payment proof file if exists
                        if ($transaction->payment_proof) {
                            Storage::delete('public/payment_proofs/' . $transaction->payment_proof);
                        }
                        
                        $transaction->delete();
                        $successCount++;
                        break;
                }
            }

            DB::commit();

            $actionText = [
                'approve' => 'diterima',
                'reject' => 'ditolak',
                'delete' => 'dihapus'
            ];

            return redirect()->route('admin.transaksi.index')
                ->with('success', "{$successCount} transaksi berhasil {$actionText[$request->action]}.");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Terjadi kesalahan saat memproses transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Export transactions data.
     */
    public function export(Request $request)
    {
        $query = Transaction::with(['user', 'kursus'])
            ->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('kursus', function($kursusQuery) use ($search) {
                    $kursusQuery->where('nama', 'like', "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transactions = $query->get();

        // Create CSV content
        $csvContent = "ID,Nama Pengguna,Email,Kursus,Kategori,Jumlah,Status,Tanggal\n";
        
        foreach ($transactions as $transaction) {
            $csvContent .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s,%s\n",
                $transaction->id,
                $transaction->user->name,
                $transaction->user->email,
                $transaction->kursus->nama,
                $transaction->kursus->kategori,
                $transaction->amount,
                $transaction->status,
                $transaction->created_at->format('Y-m-d H:i:s')
            );
        }

        $fileName = 'transaksi_' . now()->format('Y_m_d_His') . '.csv';
        
        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    /**
     * Get transaction statistics.
     */
    public function statistics()
    {
        $stats = [
            'total_transactions' => Transaction::count(),
            'total_amount' => Transaction::where('status', 'diterima')->sum('amount'),
            'pending_transactions' => Transaction::where('status', 'belum_dibayar')->count(),
            'approved_transactions' => Transaction::where('status', 'diterima')->count(),
            'rejected_transactions' => Transaction::where('status', 'ditunda')->count(),
            'monthly_revenue' => Transaction::where('status', 'diterima')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'daily_transactions' => Transaction::whereDate('created_at', today())->count(),
        ];

        return response()->json($stats);
    }
}