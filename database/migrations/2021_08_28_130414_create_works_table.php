<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
          $table->id();
          $table->string('name')->unique();
          $table->string('email')->unique();
          $table->string('phone')->unique()->nullable();
          $table->string('image')->nullable();
          $table->string('address')->nullable();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password')->nullable();
          $table->tinyInteger('status')->default('1');
          $table->tinyInteger('is_driver')->default('0');
          $table->tinyInteger('is_helper')->default('0');
          $table->string('idImage')->nullable();
          $table->string('licenseCar')->nullable();
          $table->string('license')->nullable();
          $table->integer('age');
          $table->unsignedBigInteger('city_id')->nullable();
          $table->unsignedBigInteger('order_place')->nullable();
          $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
          $table->foreign('order_place')->references('id')->on('order_places')->cascadeOnDelete();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
