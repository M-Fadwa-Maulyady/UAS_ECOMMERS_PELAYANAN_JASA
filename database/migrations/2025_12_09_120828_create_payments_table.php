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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('method', ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'QRIS']);
        $table->string('bank_name')->nullable();
        $table->string('rekening_tujuan')->nullable();
        $table->string('bukti_transfer')->nullable();
        $table->enum('status', [
    'pending',
    'waiting_upload',   // ← INI YANG WAJIB ADA
    'waiting_verification',
    'paid',
    'sent_to_worker',
    'done'
])->default('pending');

        $table->decimal('total', 12,2);
        $table->decimal('fee_admin', 12,2)->nullable();
        $table->decimal('worker_receive', 12,2)->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
