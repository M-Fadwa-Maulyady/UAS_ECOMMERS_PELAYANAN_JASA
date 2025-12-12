<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jasa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('worker_id')->nullable()->constrained('users');

            $table->string('alamat');
            $table->string('tanggal');
            $table->integer('jumlah')->default(1);

            // STATUS FLOW TERBARU
            $table->enum('status', [
                'pending_admin',             // user pesan → admin review
                'approved_admin',            // admin setuju → lanjut pembayaran

                'waiting_payment',           // user belum pilih metode / belum bayar
                'waiting_upload',            // user pilih metode, belum upload bukti
                'waiting_verification',      // admin cek bukti pembayaran

                'rejected_admin',            // admin tolak
                'waiting_worker',            // admin valid → worker review
                'accepted_worker',           // worker terima
                'rejected_worker',           // worker tolak

                'waiting_user_confirmation', // hasil sudah upload → user cek
                'revision_requested',        // user minta perbaikan
                'finished',                  // pesanan selesai
            ])->default('pending_admin');

            // --- PAYMENT SYSTEM ---
            $table->string('payment_method')->nullable();     // qris/bank/cod
            $table->string('bukti_pembayaran')->nullable();   // bukti transfer

            $table->integer('admin_fee')->default(0);         // 10% potongan untuk admin
            $table->integer('total_transfer')->default(0);    // total bayar user

            // --- RESULT FROM WORKER ---
            $table->string('bukti_pengerjaan')->nullable();   // upload hasil pekerjaan

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
