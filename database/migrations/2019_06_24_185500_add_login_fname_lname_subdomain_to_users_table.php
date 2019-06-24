<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoginFnameLnameSubdomainToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_f')->nullable();
            $table->string('name_l')->nullable();
            $table->string('login');
            $table->string('subdomain')->nullable()->unique();
            $table->unsignedBigInteger('amember_id');
            $table->dropColumn('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name_f');
            $table->dropColumn('name_l');
            $table->dropColumn('login');
            $table->dropColumn('subdomain');
            $table->dropColumn('amember_id');
            $table->text('password');
        });
    }
}
