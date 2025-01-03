<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionItems extends Migration
{
    public function up()
    {
        Schema::create('home_section_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('home_id');
            $table->string('title');
            $table->text('description');
            $table->string('image')->default('default.png');
            $table->timestamps();

            $table->foreign('home_id')->references('id')->on('home_sections')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_section_items');
    }
}
