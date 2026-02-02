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
    Schema::create('bot_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('bot_type')->nullable();
        $table->string('platform')->nullable();
        $table->string('market')->nullable();
        $table->string('risk_profile')->nullable();
        $table->string('timeframe')->nullable();

        $table->text('strategy_notes')->nullable();
        $table->string('budget_range')->nullable();
        $table->string('contact')->nullable();

        $table->enum('status', [
            'new',
            'quoted',
            'accepted',
            'rejected',
            'in_progress',
            'delivered'
        ])->default('new');

        $table->decimal('quoted_amount', 10, 2)->nullable();
        $table->text('quote_message')->nullable();
        $table->timestamp('quote_sent_at')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_requests');
    }
};
