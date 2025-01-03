<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 100)->default('QFAvionics');
            $table->string('email', 70)->default('info@qfavionics.com');
            $table->string('phone_number_1', 10)->nullable();
            $table->string('phone_number_2', 10)->nullable();
            $table->string('bussiness_email', 70)->default('info@qfavionics.com');
            $table->decimal('currency_rate', 3, 2)->default(0.72);
            $table->text('address')->nullable();
            $table->text('airport')->nullable();
            $table->string('email_app_password', 30)->nullable();
            $table->decimal('tax', 5, 2)->default(0.15);
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};
