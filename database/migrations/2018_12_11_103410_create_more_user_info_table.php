<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoreUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('tel2');
            $table->string('city');
            $table->string('previous_work');
            $table->string('previous_work_timeline');
            $table->integer('availability');
            $table->string('urgent_work');
            $table->string('citations');
            $table->string('highest_qualification');
            $table->string('proficiencies');
            $table->string('relevant_info');
            $table->rememberToken();
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
        Schema::dropIfExists('more_user_info');
    }
}
