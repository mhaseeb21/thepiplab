<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->enum('status', ['pending','approved','rejected'])->default('pending')->after('description');
            $table->timestamp('reviewed_at')->nullable()->after('status');

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->index(['status']);
            $table->index(['email']);
        });
    }

    public function down(): void
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id','status','reviewed_at']);
        });
    }
};