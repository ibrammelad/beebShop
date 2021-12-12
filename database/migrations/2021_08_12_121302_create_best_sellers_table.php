<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->unique();
            $table->integer('frequency')->default(0);
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('best_sellers');
    }
}
