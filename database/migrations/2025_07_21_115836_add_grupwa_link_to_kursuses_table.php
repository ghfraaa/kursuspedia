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
        Schema::table('kursuses', function (Blueprint $table) {
            Schema::table('kursuses', function (Blueprint $table) {
            $table->string('grupwa_link')->nullable()->after('jumlah_siswa');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kursuses', function (Blueprint $table) {
            $table->dropColumn('grupwa_link');
        });
    }
};
