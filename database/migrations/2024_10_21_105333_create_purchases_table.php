<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Client who made the purchase
            $table->string('transaction_id');
            $table->string('product_type'); // 'signals', 'course', 'bot'
            $table->decimal('amount', 8, 2);
            $table->string('payment_proof'); // Screenshot of payment proof
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Purchase status
            $table->dateTime('expires_at')->nullable(); // Subscription expiry for signals
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
