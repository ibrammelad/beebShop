<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('quantity_type');
            $table->string('quantity');
            $table->string('image');
            $table->float('price');
            $table->float('discount');
            $table->float('cost1');
            $table->float('cost2');
            $table->float('cost3');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_offer')->default(0);
            $table->decimal('pricebypoint');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
