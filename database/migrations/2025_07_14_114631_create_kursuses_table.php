<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Kursus;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kursuses', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gambar')->nullable();
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->enum('metode', ['online', 'offline', 'hybrid']);
            $table->string('lokasi')->nullable(); // kalau offline
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('harga')->default(0);
            $table->boolean('sertifikat')->default(false);
            $table->integer('siswa_terdaftar');
            $table->integer('jumlah_siswa')->default(0);
            $table->foreignId('pengajar_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursuses');
    }
};
