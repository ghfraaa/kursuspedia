<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    protected $table = "kursuses"; // Ensure the table name matches the migration

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
        'grupwa_link'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // App\Models\Kursus.php
    public function users()
    {
        return $this->belongsToMany(User::class, 'transactions', 'kursus_id', 'user_id')
            ->withPivot('status');
    }


}
