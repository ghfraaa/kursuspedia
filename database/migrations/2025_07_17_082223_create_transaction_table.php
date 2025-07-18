<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel users
            $table->foreignId('kursus_id')->constrained('kursuses')->onDelete('cascade'); // Foreign key ke tabel kursuses
            $table->decimal('amount', 10, 2); // Harga transaksi
            $table->string('status')->default('belum_dibayar'); // Status: belum_dibayar, pending, diterima
            $table->string('payment_proof')->nullable(); // Path ke bukti pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

