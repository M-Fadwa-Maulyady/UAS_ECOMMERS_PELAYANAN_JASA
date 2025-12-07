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

        $table->unsignedBigInteger('user_id');

        // tidak perlu kolom nama
        $table->string('nama_jasa');
        $table->string('slug')->unique();

        $table->text('deskripsi');
        $table->string('harga')->nullable();
        $table->integer('estimasi_waktu')->nullable();
        $table->string('durasi')->nullable();
        $table->string('kontak')->nullable();
        $table->string('gambar')->nullable();

        $table->unsignedBigInteger('kategori_id')->nullable();

        $table->tinyInteger('status')->default(0);
        $table->text('alasan_tolak')->nullable();

        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('jasas');
    }
};
