<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->text('message')->nullable();
            $table->string('leads_status')->nullable();
            $table->text('leads_note')->nullable();
            $table->integer('leads_total_move')->nullable();
            $table->string('path_referral')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('updated_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
