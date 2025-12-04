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

            // Role user
            $table->enum('role', ['admin','user','pekerja'])->default('user');

            // Profil dasar
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();

            // Profil pekerja
            $table->string('nama_usaha')->nullable();
            $table->string('kategori_jasa')->nullable();
            $table->text('deskripsi_jasa')->nullable();

            // Status verifikasi
            $table->string('ktp')->nullable();
            $table->boolean('profile_filled')->default(false);
            $table->boolean('is_verified_by_admin')->default(false);  // hanya 1 kali
            $table->boolean('is_pro_active')->default(false);

            // Rekening
            $table->string('rekening_bank')->nullable();
            $table->string('rekening_nama')->nullable();
            $table->string('rekening_nomor')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        // Table sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Forgot password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
