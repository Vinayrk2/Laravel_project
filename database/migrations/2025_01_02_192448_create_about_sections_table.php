<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_content_id')->constrained('about_contents')->onDelete('cascade');
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->json('column'); // Store as JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_sections');
    }
};
