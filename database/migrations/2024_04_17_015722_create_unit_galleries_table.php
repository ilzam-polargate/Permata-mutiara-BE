<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('unit_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_type_id');
            $table->foreign('unit_type_id')->references('id')->on('unit_types')->onDelete('cascade');
            $table->string('gallery_image')->nullable();
            $table->string('caption_image')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_galleries');
    }
}

