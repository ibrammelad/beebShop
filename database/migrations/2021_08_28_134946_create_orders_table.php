<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('delivery_id')->nullable();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('place_id')->nullable();
      $table->unsignedBigInteger('city_id')->nullable();
      $table->string('address')->nullable();
      $table->float('order_cost')->nullable();
      $table->integer('reward_points')->nullable();
      $table->tinyInteger('status');
      $table->timestamps();
      $table->foreign('delivery_id')->references('id')->on('works')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('place_id')->references('id')->on('order_places')->onDelete('cascade');
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('orders');
  }
}
