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
        Schema::create('user_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References users table
            $table->foreignId('challenge_id')->constrained()->onDelete('cascade'); // References challenges table
            $table->string('proof')->nullable(); // Stores the file path of uploaded proof
            $table->boolean('completed')->default(false); // Tracks whether the challenge is completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
