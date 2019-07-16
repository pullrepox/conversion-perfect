<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBarsClickLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars_click_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('bar_id')->unsigned()->index();
            $table->foreign('bar_id')->references('id')->on('bars')->onDelete('cascade');
            $table->bigInteger('split_bar_id')->index();
            $table->string('cookie', 50)->index();
            $table->boolean('unique_click')->index();
            $table->boolean('unique_click_per_day');
            $table->string('ip_address', 50)->nullable();
            $table->mediumText('agents')->nullable();
            $table->string('kind', 16)->nullable();
            $table->string('model', 64)->nullable();
            $table->string('platform', 64)->nullable();
            $table->string('platform_version', 16)->nullable();
            $table->boolean('is_mobile');
            $table->string('browser', 100)->nullable();
            $table->string('domain')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('country_code', 2)->index();
            $table->string('country_code3', 3)->nullable();
            $table->string('country_name')->nullable();
            $table->string('region', 2)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->bigInteger('area_code');
            $table->string('continent_code', 2)->nullable();
            $table->string('language_pref', 100)->nullable();
            $table->string('language_range', 100)->index();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unique(['id', 'user_id', 'bar_id']);
            $table->engine = 'InnoDB';
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bars_click_logs');
    }
}
