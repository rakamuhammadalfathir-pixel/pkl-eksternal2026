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
        Schema::table('pengembalians', function (Blueprint $table) {
            // Menambahkan kolom status dan tanggal bayar
            $table->string('status_denda')->default('Belum Bayar')->after('denda');
            $table->timestamp('tanggal_bayar')->nullable()->after('status_denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['status_denda', 'tanggal_bayar']);
        });
    }
};