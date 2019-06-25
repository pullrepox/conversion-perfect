<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('amember_id')->unsigned()->index();
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('expiry')->nullable();
            
            $table->timestamps();
            $table->unique(['amember_id', 'id']);
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
        Schema::dropIfExists('subscriptions');
    }
}
