<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('friendly_name');
            $table->enum('position', ['top', 'bottom']);
            $table->bigInteger('group_id');
            $table->text('headline')->nullable();
            $table->string('headline_color', 20)->nullable();
            $table->string('background_color', 20)->nullable();
            
            $table->boolean('opt_display')->default(0);
            $table->boolean('opt_content')->default(0);
            $table->boolean('opt_appearance')->default(0);
            $table->boolean('opt_button')->default(0);
            $table->boolean('opt_countdown')->default(0);
            $table->boolean('opt_overlay')->default(0);
            $table->boolean('opt_opt_in')->default(0);
            $table->boolean('opt_custom_text')->default(0);
            
            $table->longText('html')->nullable();
            
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unique(['user_id', 'id']);
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
        Schema::dropIfExists('bars');
    }
}
