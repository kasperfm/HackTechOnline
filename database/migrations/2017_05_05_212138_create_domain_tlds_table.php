<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainTldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_tlds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_provider_id')->unsigned()->nullable();
            $table->string('tld');
            $table->integer('days_to_hold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_tlds');
    }
}
