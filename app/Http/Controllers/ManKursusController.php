<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ManKursusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query
        $query = Kursus::query();

        // Filter by category if provided
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by search term if provided
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by status (aktif, akan_datang, selesai)
        if ($request->filled('status')) {
            $status = $request->status;
            $now = Carbon::now()->toDateString(); // Ambil tanggal hari ini dalam format YYYY-MM-DD

            $query->where(function($q) use ($status, $now) {
                if ($status === 'aktif') {
                    // Kursus aktif: tanggal_mulai <= hari ini DAN tanggal_selesai >= hari ini
                    $q->where('tanggal_mulai', '<=', $now)
                      ->where('tanggal_selesai', '>=', $now);
                } elseif ($status === 'akan_datang') {
                    // Kursus akan datang: tanggal_mulai > hari ini
                    $q->where('tanggal_mulai', '>', $now);
                } elseif ($status === 'selesai') {
                    // Kursus selesai: tanggal_selesai < hari ini
                    $q->where('tanggal_selesai', '<', $now);
                }
            });
        }

        // Paginate results
        $kursuses = $query->paginate(15);
        return view('admin.kursus.index', compact('kursuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kursus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'metode' => 'required|string|max:50',
            'lokasi' => 'required_unless:metode,online',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga' => 'required|numeric|min:0',
            'sertifikat' => 'required|boolean',
            'jumlah_siswa' => 'required|integer|min:1'
        ]);

        $data = $request->all();
        $data['siswa_terdaftar'] = 0; // Default value

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            
            // Generate unique filename
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Pastikan folder kursus exist
            $kursusPath = storage_path('app/public/kursus');
            if (!file_exists($kursusPath)) {
                mkdir($kursusPath, 0755, true);
            }
            
            // Store file menggunakan disk public
            $stored = $image->storeAs('kursus', $imageName, 'public');
            
            // Debug: log untuk memastikan file tersimpan
            \Log::info('File stored: ' . $stored);
            \Log::info('Full path: ' . storage_path('app/public/kursus/' . $imageName));
            \Log::info('File exists: ' . (file_exists(storage_path('app/public/kursus/' . $imageName)) ? 'YES' : 'NO'));
            
            // Pastikan file benar-benar tersimpan
            if ($stored && file_exists(storage_path('app/public/kursus/' . $imageName))) {
                $data['gambar'] = $imageName;
            } else {
                return back()->withErrors(['gambar' => 'Gagal menyimpan gambar']);
            }
        }

        Kursus::create($data);

        return redirect()->route('admin.kursus.index')
            ->with('success', 'Kursus berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kursus $kursus)
    {
        return view('admin.kursus.show', compact('kursus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kursus $kursus)
    {
        return view('admin.kursus.edit', compact('kursus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kursus $kursus)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'metode' => 'required|string|max:50',
            'lokasi' => 'required_unless:metode,online',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga' => 'required|numeric|min:0',
            'sertifikat' => 'required|boolean',
            'jumlah_siswa' => 'required|integer|min:1|min:' . $kursus->siswa_terdaftar
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($kursus->gambar && file_exists(storage_path('app/public/kursus/' . $kursus->gambar))) {
                unlink(storage_path('app/public/kursus/' . $kursus->gambar));
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Pastikan folder kursus exist
            $kursusPath = storage_path('app/public/kursus');
            if (!file_exists($kursusPath)) {
                mkdir($kursusPath, 0755, true);
            }
            
            // Store file menggunakan disk public
            $stored = $image->storeAs('kursus', $imageName, 'public');
            
            if ($stored && file_exists(storage_path('app/public/kursus/' . $imageName))) {
                $data['gambar'] = $imageName;
            } else {
                return back()->withErrors(['gambar' => 'Gagal menyimpan gambar']);
            }
        }

        $kursus->update($data);

        return redirect()->route('admin.kursus.index')
            ->with('success', 'Kursus berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kursus $kursus)
    {
        // Delete image if exists
        if ($kursus->gambar && file_exists(storage_path('app/public/kursus/' . $kursus->gambar))) {
            unlink(storage_path('app/public/kursus/' . $kursus->gambar));
        }

        $kursus->delete();

        return redirect()->route('admin.kursus.index')
            ->with('success', 'Kursus berhasil dihapus!');
    }

    public function export(Request $request)
    {
        // Membangun query untuk mengambil data kursus
        // Tidak memuat relasi apapun karena kategori ada di tabel kursus itu sendiri
        $query = Kursus::orderBy('created_at', 'desc');

        // Menerapkan filter yang sama seperti pada halaman indeks
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Mencari di kolom 'nama' pada model Kursus itu sendiri
                $q->where('nama', 'like', "%{$search}%")
                  // Mencari di kolom 'kategori' pada model Kursus itu sendiri
                  ->orWhere('kategori', 'like', "%{$search}%") // Mengubah dari orWhereHas relasi ke kolom langsung
                  // Mencari di kolom 'id' pada model Kursus
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori (asumsi 'kategori' di request adalah nilai kolom kategori)
        if ($request->filled('kategori')) {
            // Asumsi kolom 'kategori' di tabel kursus menyimpan nama/nilai kategori
            $query->where('kategori', $request->kategori); 
        }

        // Filter berdasarkan status (aktif, akan_datang, selesai)
        if ($request->filled('status')) {
            $status = $request->status;
            $now = Carbon::now()->toDateString(); // Ambil tanggal hari ini dalam format YYYY-MM-DD

            $query->where(function($q) use ($status, $now) {
                if ($status === 'aktif') {
                    // Kursus aktif: tanggal_mulai <= hari ini DAN tanggal_selesai >= hari ini
                    $q->where('tanggal_mulai', '<=', $now)
                      ->where('tanggal_selesai', '>=', $now);
                } elseif ($status === 'akan_datang') {
                    // Kursus akan datang: tanggal_mulai > hari ini
                    $q->where('tanggal_mulai', '>', $now);
                } elseif ($status === 'selesai') {
                    // Kursus selesai: tanggal_selesai < hari ini
                    $q->where('tanggal_selesai', '<', $now);
                }
            });
        }
        
        // Ambil semua data kursus yang telah difilter
        $kursuses = $query->get();

        // Membuat konten CSV
        // Header CSV
        $csvContent = "ID,Nama,Kategori,Metode,Lokasi,Tanggal Mulai,Tanggal Selesai,Harga,Siswa Terdaftar,Jumlah Siswa,Status\n"; // Menambahkan kolom Status

        // Mengisi baris data CSV
        foreach ($kursuses as $kursus) {
            // Menentukan status kursus secara dinamis untuk CSV
            $now = Carbon::now();
            $start = Carbon::parse($kursus->tanggal_mulai);
            $end = Carbon::parse($kursus->tanggal_selesai);

            $status_kursus = '';
            if ($now->lt($start)) {
                $status_kursus = 'Akan Datang';
            } elseif ($now->between($start, $end)) {
                $status_kursus = 'Aktif';
            } else {
                $status_kursus = 'Selesai';
            }

            $csvContent .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s\n", // Menambahkan %s untuk Status
                $kursus->id,
                $kursus->nama,
                // Mengakses kolom 'kategori' secara langsung dari objek kursus
                $kursus->kategori ?? 'N/A', // Gunakan 'N/A' jika kolom kategori kosong
                $kursus->metode,
                $kursus->lokasi,
                $kursus->tanggal_mulai,
                $kursus->tanggal_selesai,
                $kursus->harga,
                $kursus->siswa_terdaftar,
                $kursus->jumlah_siswa,
                $status_kursus // Menambahkan status kursus dinamis
            );
        }

        // Menentukan nama file CSV
        $fileName = 'kursus_' . now()->format('Y_m_d_His') . '.csv';

        // Mengirimkan file CSV sebagai respons download
         return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}