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
        Schema::create('price_breack_downs', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->string('price');
            $table->string('making');
            $table->string('making_price');
            $table->string('discount');
            $table->string('tax');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_breack_downs');
    }
};
