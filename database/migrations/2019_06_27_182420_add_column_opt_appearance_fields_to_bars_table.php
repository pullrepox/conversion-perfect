<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOptAppearanceFieldsToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->tinyInteger('opacity')->after('opt_appearance')->default(100);
            $table->boolean('drop_shadow')->after('opacity');
            $table->boolean('close_button')->after('drop_shadow');
            $table->boolean('background_gradient')->after('close_button');
            $table->string('gradient_end_color', 20)->after('background_gradient')->nullable();
            $table->tinyInteger('gradient_angle')->after('gradient_end_color');
            $table->enum('powered_by_position', ['bottom_right', 'bottom_left', 'top_left', 'hidden'])->default('bottom_right')->after('gradient_angle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->dropColumn('opacity');
            $table->dropColumn('drop_shadow');
            $table->dropColumn('close_button');
            $table->dropColumn('background_gradient');
            $table->dropColumn('gradient_end_color');
            $table->dropColumn('gradient_angle');
            $table->dropColumn('powered_by_position');
        });
    }
}
