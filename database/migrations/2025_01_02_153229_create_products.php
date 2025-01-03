<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('products')) {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('part_number', 30)->nullable()->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->json('features');
            $table->string('more_details')->nullable();
            $table->string('manufacturer', 100)->nullable();
            $table->string('condition', 50)->nullable();
            $table->string('availability', 50)->nullable();
            $table->timestamps();
        });
    }
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};