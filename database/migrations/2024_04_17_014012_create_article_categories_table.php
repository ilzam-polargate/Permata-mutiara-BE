<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('article_category_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
