<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class ManKursusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kursuses = Kursus::latest()->paginate(10);
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
    public function show( $id)
    {
        $kursus = Kursus::findOrFail($id);
        $user = auth()->user();

        $siswa_terdaftar = $kursus->users()
            ->wherePivotIn('status', ['diterima', 'selesai'])
            ->get();

        return view('admin.kursus.show', compact('kursus', 'siswa_terdaftar'));
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
}