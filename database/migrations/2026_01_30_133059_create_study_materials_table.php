<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();

            // 1) what it is
            $table->enum('type', ['lecture', 'resource']); // lecture slides vs helping materials
            $table->string('title');
            $table->text('description')->nullable();

            // 2) file info
            $table->string('file_path');     // storage path (s3/r2/local)
            $table->string('original_name'); // original uploaded name
            $table->string('mime')->nullable();
            $table->unsignedBigInteger('size')->nullable();

            // 3) organization
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};
