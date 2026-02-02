<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('bot_request_id')
                  ->nullable()
                  ->after('user_id');

            $table->foreign('bot_request_id')
                  ->references('id')
                  ->on('bot_requests')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['bot_request_id']);
            $table->dropColumn('bot_request_id');
        });
    }
};
