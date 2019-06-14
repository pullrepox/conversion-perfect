<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->string('name',255);
            $table->tinyInteger('type')->default(1);
            $table->unsignedBigInteger('link_click')->default(0);
            $table->unsignedBigInteger('email_options')->default(0);
            $table->unsignedBigInteger('total_views')->default(0);
            $table->unsignedBigInteger('unique_views')->default(0);
            $table->text('heading')->nullable();
            $table->text('subheading')->nullable();
            $table->boolean('status')->default(0);

            $table->longText('shared')->nullable();
            $table->longText('settings')->nullable();
            $table->longText('countdown')->nullable();
            $table->longText('button')->nullable();
            $table->longText('branding')->nullable();

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
        Schema::dropIfExists('sliders');
    }
}
