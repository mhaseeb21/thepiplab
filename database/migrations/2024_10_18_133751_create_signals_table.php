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
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->string('pair_name'); // e.g., EUR/USD
            $table->enum('signal_type', ['buy', 'sell']); // Buy or Sell
            $table->string('image'); // Image path
            $table->text('description'); // Signal description
            $table->string('result'); // TP/SL result
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};
