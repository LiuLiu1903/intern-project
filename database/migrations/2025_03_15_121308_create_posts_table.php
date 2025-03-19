<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 100);
            $table->string('slug', 100)->unique();
            $table->string('description', 200)->nullable();
            $table->text('content');
            $table->timestamp('publish_date')->nullable();
            $table->tinyInteger('status')->default(0); // 0 = bài viết mới, 1 = cập nhật, 2 = ẩn
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('posts');
    }
};