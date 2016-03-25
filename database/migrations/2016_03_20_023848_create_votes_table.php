<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('link_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('current_vote')->default(0);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
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
        Schema::drop('votes');
    }
}
