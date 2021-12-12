<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('shopping_carts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id');
      $table->foreignId('item_id');
      $table->foreignId('order_id')->nullable();
      $table->integer('quantity');
      $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
      $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
      $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();

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
    Schema::dropIfExists('shopping_carts');
  }
}
