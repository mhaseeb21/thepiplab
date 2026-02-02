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
        Schema::table('purchases', function (Blueprint $table) {
        $table->string('transaction_id')->nullable()->change();
        $table->string('payment_proof')->nullable()->change();

        $table->string('provider')->nullable()->after('payment_proof');     // nowpayments
        $table->string('payment_id')->nullable()->after('provider');        // NOWPayments payment_id
        $table->json('payload')->nullable()->after('payment_id');           // store webhook/payment payload
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
