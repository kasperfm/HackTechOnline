<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('item_type')->index();
            $table->integer('reference_id')->nullable()->index();
            $table->integer('drop_chance')->default(100);
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
        Schema::dropIfExists('reward_items');
    }
}
