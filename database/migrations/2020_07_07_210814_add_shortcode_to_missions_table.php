<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortcodeToMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->string('shortcode', 100)->after('id')->index();
        });

        $mission1 = \App\Models\Mission::find(1);
        $mission1->shortcode = 'PSYBYTES-01-INTRO';
        $mission1->save();

        $mission2 = \App\Models\Mission::find(2);
        $mission2->shortcode = 'PSYBYTES-02-PWDCRACK';
        $mission2->save();

        $mission3 = \App\Models\Mission::find(3);
        $mission3->shortcode = 'PSYBYTES-03-NEWIP';
        $mission3->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->dropColumn('shortcode');
        });
    }
}
