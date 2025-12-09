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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // pelanggan
        $table->foreignId('jasa_id')->constrained()->cascadeOnDelete(); // jasa yang dipesan
        $table->foreignId('worker_id')->nullable()->constrained('users'); // pekerja jasa

        $table->string('alamat');
        $table->string('tanggal');
        $table->integer('jumlah')->default(1);

        // Status alur
        $table->enum('status', [
            'pending_admin',   // user pesan → admin review
            'approved_admin',  // admin setuju → menuju pekerja
            'rejected_admin',  // admin tolak

            'waiting_worker',  // pekerja harus approve
            'accepted_worker', // pekerja terima
            'rejected_worker', // pekerja tolak
        ])->default('pending_admin');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
