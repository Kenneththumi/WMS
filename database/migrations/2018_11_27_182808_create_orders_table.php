<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('due_date');
            $table->string('discpline');
            $table->string('topic');
            $table->integer('sources');
            $table->string('style');
            $table->integer('pages');
            $table->string('words');
            $table->string('instructions');
            $table->integer('amount');
          $table->string('paper_type');
          $table->string('writing_type');
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
          Schema::dropIfExists('orders');
    }
}
