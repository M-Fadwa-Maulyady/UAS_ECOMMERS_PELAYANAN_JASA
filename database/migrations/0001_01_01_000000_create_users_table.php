<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Role
            $table->enum('role', ['admin', 'user', 'pekerja'])->default('user');

            // Profil dasar
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();

            // Profil pekerja
            $table->string('nama_usaha')->nullable();
            $table->string('kategori_jasa')->nullable();
            $table->text('deskripsi_jasa')->nullable();

            // Verifikasi admin
            $table->string('ktp')->nullable();
            $table->boolean('profile_filled')->default(false);

            // 0 = pending, 1 = approved, 2 = rejected
            $table->tinyInteger('is_verified_by_admin')->default(0);

            // alasan penolakan admin
            $table->text('verification_note')->nullable();

            // fitur pro (opsional)
            $table->boolean('is_pro_active')->default(false);

            // Rekening
            $table->string('rekening_bank')->nullable();
            $table->string('rekening_nama')->nullable();
            $table->string('rekening_nomor')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
