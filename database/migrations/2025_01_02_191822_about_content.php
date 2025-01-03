<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();
            $table->text('main_description');
            $table->string('field1', 20);
            $table->text('field1_description');
            $table->string('field2', 20);
            $table->text('field2_description');
            $table->string('field3', 20);
            $table->text('field3_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_contents');
    }
};
