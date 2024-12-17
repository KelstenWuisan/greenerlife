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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->unsignedBigInteger('user_id'); // Add 'user_id' if it doesn't exist
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->longText('image')->nullable();
            $table->string('slug')->unique();
            $table->text("location");
            $table->text("body");
            $table->unsignedInteger('rsvp_limit')->default(100); // Default limit is 100
            $table->unsignedInteger('rsvp_count')->default(0);   // Default RSVP count
            $table->timestamp("published_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
