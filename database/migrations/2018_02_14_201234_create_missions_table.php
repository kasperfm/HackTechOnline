<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->text('complete_message');
            $table->integer('reward_trust')->unsigned()->default(0);
            $table->integer('reward_credits')->unsigned()->default(0);
            $table->integer('corp_id')->unsigned();
            $table->string('type');
            $table->string('objective');
            $table->integer('minimum_trust')->unsigned()->default(0);
            $table->tinyInteger('hidden')->default(0);
            $table->integer('chain_parent')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
