<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content'); // HTML or text (you can paste formatted content)

            $table->string('cover_image')->nullable(); // stored on public disk
            $table->enum('type', ['blog', 'news'])->default('news');

            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->unsignedBigInteger('created_by')->nullable(); // admin user id (optional)
            $table->timestamps();

            // Optional: if your admins are users in users table
            // $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
