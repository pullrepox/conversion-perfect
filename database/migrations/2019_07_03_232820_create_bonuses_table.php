<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plans')->index();
            $table->string('title');
            $table->text('description');
            $table->string('image_url');
            $table->string('bonus_url');
            $table->string('link_text');
            $table->boolean('new_window')->default(1);
            $table->string('background_color', 50);
            $table->tinyInteger('image_padding');
            $table->tinyInteger('sort_order');
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
        Schema::dropIfExists('bonuses');
    }
}
