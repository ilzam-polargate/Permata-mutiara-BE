<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageBannersTable extends Migration
{
    public function up()
    {
        Schema::create('image_banners', function (Blueprint $table) {
            $table->id();
            $table->string('image_banner')->nullable();
            $table->string('headline');
            $table->string('subheadline');
            $table->string('text_button');
            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_banners');
    }
}
