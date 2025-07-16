<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    protected $table = "courses"; // Ensure the table name matches the migration

    protected $fillable = [
        'nama',
        'gambar',
        'kategori',
        'deskripsi',
        'metode',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga',
        'sertifikat',
        'siswa_terdaftar',
        'jumlah_siswa',
        'pengajar_id'
    ];
    
}
