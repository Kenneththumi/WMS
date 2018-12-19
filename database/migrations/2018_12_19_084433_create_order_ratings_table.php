<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('grammar');
            $table->integer('speed');
            $table->integer('instructions');
            $table->integer('originality');
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
        Schema::dropIfExists('order_ratings');
    }
}
