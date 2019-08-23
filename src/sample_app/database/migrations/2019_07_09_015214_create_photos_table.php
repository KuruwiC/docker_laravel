<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::disableForeignKeyConstraints();
         Schema::create('photos', function (Blueprint $table) {
             $table->string('id')->primary();
             $table->unsignedInteger('user_id');
             $table->string('filename');
             $table->timestamps();
             $table->foreign('user_id')->references('id')->on('users');
         });
         Schema::enableForeignKeyConstraints();
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('photos');
        Schema::enableForeignKeyConstraints();
    }
}
