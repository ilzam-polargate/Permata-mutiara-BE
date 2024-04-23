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
        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('header');
            $table->string('sub_header');
            $table->string('img_header');
            $table->string('about');
            $table->longText('sub_about');
            $table->string('layanan_1');
            $table->string('layanan_2');
            $table->string('layanan_3');
            $table->string('kamar');
            $table->string('sub_kamar');
            $table->string('kontak');
            $table->string('sub_kontak');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('instagram');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_settings');
    }
};
