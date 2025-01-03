<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('custom_user', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email', 100)->unique();
            $table->string('phone_number', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_user');
    }
};