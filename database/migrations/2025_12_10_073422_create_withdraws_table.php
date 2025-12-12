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
    Schema::create('withdraws', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 12, 2);
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->string('bank_name')->nullable();
        $table->string('rekening')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('withdraws');
}

};
