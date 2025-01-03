<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('image')->default('default.png');
            $table->boolean('status')->default(true);
            $table->text('description');
            $table->string('service_type', 40);
            $table->json('specifications');
            $table->json('technical_information');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
