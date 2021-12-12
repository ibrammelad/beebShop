<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('order_id')->unique();
            $table->double('total_cost');
            $table->double('actual_cost');
            $table->integer('persentDriver');
            $table->double('amountneed');
            $table->foreign('work_id')->references('id')->on('works')->cascadeOnDelete();
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
        Schema::dropIfExists('financial_works');
    }
}
