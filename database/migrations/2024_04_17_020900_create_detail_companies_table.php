<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('detail_company', function (Blueprint $table) {
            $table->id();
            $table->string('logo_header')->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('co_address');
            $table->string('co_email');
            $table->string('co_telp');
            $table->string('co_whatsapp')->nullable();
            $table->string('co_website')->nullable();
            $table->string('co_google_map')->nullable();
            $table->string('co_linkyoutube')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_company');
    }
}
