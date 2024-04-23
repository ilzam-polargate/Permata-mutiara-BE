<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareersTable extends Migration
{
    public function up()
    {
        Schema::create('career', function (Blueprint $table) {
            $table->id();
            $table->string('career_title');
            $table->text('career_description');
            $table->string('career_image')->nullable();
            $table->timestamp('career_last_apply')->nullable();
            $table->timestamp('career_date')->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->unsignedBigInteger('created_by');
            $table->timestamp('updated_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Define foreign key constraint for created_by and updated_by columns
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('career');
    }
}
