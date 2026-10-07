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

        Schema::create('manage_bvs', function (Blueprint $table) {
            $table->id();
            $table->string('slider_image');
            $table->string('mines_video');
            $table->string('during_video');
            $table->string('gallery_video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_bvs');
    }
};
