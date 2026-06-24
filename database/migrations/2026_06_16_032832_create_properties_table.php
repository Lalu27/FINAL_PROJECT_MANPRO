<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_properti');
            $table->bigInteger('harga_bulanan');
            $table->text('deskripsi');
            $table->text('alamat');            
            $table->string('gambar')->nullable(); 
            $table->string('tipe_hunian')->default('campur'); // putra, putri, campur
            $table->boolean('is_approved_by_admin')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};