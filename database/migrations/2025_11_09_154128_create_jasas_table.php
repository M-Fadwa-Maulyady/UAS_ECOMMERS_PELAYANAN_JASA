<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jasas', function (Blueprint $table) {
            $table->id();

            // data umum
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->string('harga')->nullable();
            $table->string('durasi')->nullable();
            $table->string('kontak')->nullable();
            $table->string('gambar')->nullable();

            // data untuk pekerja
            $table->string('nama_jasa')->nullable();
            $table->integer('estimasi_waktu')->nullable();

            // kategori
            $table->unsignedBigInteger('kategori_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jasas');
    }
};
