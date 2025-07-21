<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kursus;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $transaksiTerbaru = Transaction::with(['kursus', 'user'])
                                        ->latest()
                                        ->take(5)
                                        ->get();
        
        // Ambil semua kursus untuk tabel
        $semuaKursus = Kursus::latest()->take(4)->get();
        
        
        // Data untuk chart pendaftaran bulanan dari tabel transactions dengan status "diterima"
        try {
            $monthlyTransactions = DB::table('transactions')
                ->select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('status', 'diterima') // Filter berdasarkan status "diterima"
                ->where('created_at', '>=', now()->subMonths(11))
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } catch (\Exception $e) {
            // Jika ada error, coba dengan nama kolom status yang berbeda
            try {
                $monthlyTransactions = DB::table('transactions')
                    ->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('transaction_status', 'diterima')
                    ->where('created_at', '>=', now()->subMonths(11))
                    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                    ->orderBy('year', 'asc')
                    ->orderBy('month', 'asc')
                    ->get();
            } catch (\Exception $e2) {
                // Jika masih error, gunakan data kosong
                $monthlyTransactions = collect();
            }
        }

        // Inisialisasi array untuk 12 bulan terakhir
        $months = [];
        $monthlyData = [];
        $monthKeys = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            $monthlyData[] = 0;
            $monthKeys[$date->format('Y-n')] = count($monthKeys);
        }

        // Isi data aktual dari database
        foreach ($monthlyTransactions as $transaction) {
            $key = $transaction->year . '-' . $transaction->month;
            if (isset($monthKeys[$key])) {
                $index = $monthKeys[$key];
                $monthlyData[$index] = (int)$transaction->total;
            }
        }

        $monthlyChartData = [
            'labels' => $months,
            'data' => $monthlyData
        ];

        // Fallback: jika tidak ada data sama sekali, gunakan dummy data
        if (array_sum($monthlyData) == 0) {
            $monthlyChartData = [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'data' => [12, 19, 15, 25, 22, 30, 28, 32, 25, 28, 35, 40]
            ];
        }
        
        // Data untuk chart kategori kursus
        $kategoriData = Kursus::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();
            
        $categoryChart = [
            'labels' => $kategoriData->pluck('kategori')->toArray(),
            'data' => $kategoriData->pluck('total')->toArray(),
            'colors' => [
                '#3B82F6', // Blue
                '#10B981', // Green
                '#F59E0B', // Yellow
                '#EF4444', // Red
                '#8B5CF6', // Purple
                '#F97316', // Orange
                '#06B6D4', // Cyan
                '#84CC16', // Lime
            ]
        ];
        
        return view('admin.dashboard', compact(
            'totalKursus', 
            'totalUser', 
            'totalSiswaTerdaftar', 
            'totalPendapatan',
            'kursusPopuler',
            'transaksiTerbaru',
            'semuaKursus',
            'monthlyChartData',
            'categoryChart'
        ));
    }
}