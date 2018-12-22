<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostnames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hostname')->index();
            $table->integer('host_id')->unsigned()->index();
            $table->integer('domain_provider_id')->unsigned()->nullable()->index();
            $table->timestamp('expire_date')->nullable();
            $table->tinyInteger('activated')->default(1)->index();
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
        Schema::dropIfExists('hostnames');
    }
}
