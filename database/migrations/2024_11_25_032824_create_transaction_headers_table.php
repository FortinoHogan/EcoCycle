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
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->foreignId('buyer_id')->constrained('buyers');
            $table->integer('total_price');
            $table->integer('shipping_fee');
            $table->integer('grand_total');
            $table->string('snap_token')->nullable();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_headers');
    }
};
