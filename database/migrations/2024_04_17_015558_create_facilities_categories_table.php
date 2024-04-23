<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('facilities_categories', function (Blueprint $table) {
            $table->id();
            $table->string('cat_image')->nullable();
            $table->string('cat_title');
            $table->string('cat_subtitle')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('facilities_categories');
    }
}
