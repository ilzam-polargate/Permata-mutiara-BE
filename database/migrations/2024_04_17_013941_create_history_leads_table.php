<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('history_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leads_id');
            $table->unsignedBigInteger('sales_id');
            $table->timestamp('created_date')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_leads');
    }
}
