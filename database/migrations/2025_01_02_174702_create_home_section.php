<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSection extends Migration
{
    public function up()
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // Create the singleton instance
        \App\Models\HomeSection::getInstance();
    }

    public function down()
    {
        Schema::dropIfExists('home_sections');
    }
}
