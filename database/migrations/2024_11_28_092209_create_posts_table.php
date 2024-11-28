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
            $table->foreignId('buyer_id')->constrained('buyers')->cascadeOnDelete();
            $table->text('content');
            $table->binary('image')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE posts MODIFY image LONGBLOB');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
