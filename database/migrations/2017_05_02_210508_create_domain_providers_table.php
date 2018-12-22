<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('host_id')->unsigned()->nullable()->index();
            $table->integer('max_domains')->nullable();
            $table->float('price_factor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_providers');
    }
}
