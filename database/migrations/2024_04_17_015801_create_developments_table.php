<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopmentsTable extends Migration
{
    public function up()
    {
        Schema::create('developments', function (Blueprint $table) {
            $table->id();
            $table->string('dev_image')->nullable();
            $table->string('dev_name');
            $table->text('dev_description');
            $table->enum('dev_category', ['residential', 'commercial']);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_subsidi')->default(false);
            $table->boolean('is_sold')->default(false);
            $table->dateTime('created_date')->default(now()); // Default value untuk created_date
            $table->unsignedBigInteger('created_by');
            $table->dateTime('updated_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
    
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
    
            $table->timestamps(); // Kolom created_at dan updated_at otomatis ditambahkan
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('developments'); // Ubah penamaan tabel yang di-drop menjadi plural 'developments'
    }
}

