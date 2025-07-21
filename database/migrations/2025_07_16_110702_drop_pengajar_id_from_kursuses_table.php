<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('kursuses', function (Blueprint $table) {
        //     // Hapus foreign key constraint terlebih dahulu
        //     $table->dropForeign(['pengajar_id']);

        //     // Lalu hapus kolomnya
        //     $table->dropColumn('pengajar_id');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('kursuses', function (Blueprint $table) {
        //     $table->foreignId('pengajar_id')->constrained('users')->onDelete('cascade');
        // });
    }
};
