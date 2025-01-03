<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCaresoleImage extends Migration
{
    public function up()
    {
        Schema::create('carasole_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('home_id');
            $table->string('image')->default('default.png');
            $table->timestamps();

            $table->foreign('home_id')->references('id')->on('home_sections')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carasole_images');
    }
}
