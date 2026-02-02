<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('signals', function (Blueprint $table) {

            $table->string('after_image')->nullable()->after('image');

            $table->string('tp1')->nullable()->after('description');
            $table->string('tp2')->nullable()->after('tp1');
            $table->text('entry_criteria')->nullable()->after('tp2');

            $table->enum('result_status', [
                'pending',
                'tp_hit',
                'sl_hit',
                'entry_not_met'
            ])->default('pending')->after('entry_criteria');
        });
    }

    public function down(): void
    {
        Schema::table('signals', function (Blueprint $table) {
            $table->dropColumn(['after_image','tp1','tp2','entry_criteria','result_status']);
        });
    }
};