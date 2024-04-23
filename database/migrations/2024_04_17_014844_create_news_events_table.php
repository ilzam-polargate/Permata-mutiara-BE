<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsEventsTable extends Migration
{
    public function up()
    {
        Schema::create('news_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_category_id');
            $table->string('article_title');
            $table->text('article_description');
            $table->datetime('article_date')->nullable();
            $table->string('article_image')->nullable();
            $table->string('article_caption')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('article_category_id')->references('id')->on('article_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_events');
    }
}
