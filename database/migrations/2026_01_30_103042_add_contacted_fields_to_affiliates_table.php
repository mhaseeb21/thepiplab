<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->boolean('is_contacted')->default(false)->after('description');
            $table->timestamp('contacted_at')->nullable()->after('is_contacted');
        });
    }

    public function down(): void
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropColumn(['is_contacted','contacted_at']);
        });
    }
};
