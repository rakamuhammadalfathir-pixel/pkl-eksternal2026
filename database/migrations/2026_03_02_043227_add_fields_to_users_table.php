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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['customer', 'admin'])
              ->default('customer')
              ->after('password');

        $table->string('avatar')
              ->nullable()
              ->after('role');

        // KOLOM google_id DIHAPUS DARI SINI

        $table->string('telepon', 20)
              ->nullable()
              ->after('avatar'); // Ubah posisi 'after' ke avatar

        $table->text('alamat')
              ->nullable()
              ->after('telepon');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Hapus google_id dari daftar dropColumn
        $table->dropColumn(['role', 'avatar', 'telepon', 'alamat']);
    });
}
};
