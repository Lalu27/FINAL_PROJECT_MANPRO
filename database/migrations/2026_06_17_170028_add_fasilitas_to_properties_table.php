<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Menambahkan kolom fasilitas teks yang boleh kosong (nullable) tepat setelah kolom deskripsi
            $table->text('fasilitas')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Menghapus kembali kolom fasilitas jika migrasi di-rollback
            $table->dropColumn('fasilitas');
        });
    }
};