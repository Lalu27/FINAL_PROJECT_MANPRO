<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKamarTersediaToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $blueprint) {
            // Menambahkan kolom kamar_tersedia dengan nilai bawaan 1 setelah kolom tipe_hunian
            $blueprint->integer('kamar_tersedia')->default(1)->after('tipe_hunian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $blueprint) {
            $blueprint->dropColumn('kamar_tersedia');
        });
    }
}