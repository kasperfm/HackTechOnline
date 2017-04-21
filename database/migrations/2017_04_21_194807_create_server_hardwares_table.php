<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerHardwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_hardwares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_name');
            $table->integer('price')->unsigned();
            $table->tinyInteger('type');
            $table->integer('value')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_hardwares');
    }
}
