<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOptAutoresponderFieldsToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->boolean('opt_autoresponder')->after('meta_keywords');
            $table->string('integration_type')->default('none')->after('opt_autoresponder');
            $table->string('list')->nullable()->after('integration_type');
            $table->enum('after_submit', ['show_message', 'redirect'])->default('show_message')->after('list');
            $table->text('message')->nullable()->after('after_submit');
            $table->double('autohide_delay_seconds')->nullable()->after('message');
            $table->string('redirect_url')->nullable()->after('autohide_delay_seconds');
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
            $table->dropColumn('opt_autoresponder');
            $table->dropColumn('integration_type');
            $table->dropColumn('list');
            $table->dropColumn('after_submit');
            $table->dropColumn('message');
            $table->dropColumn('autohide_delay_seconds');
            $table->dropColumn('redirect_url');
        });
    }
}
