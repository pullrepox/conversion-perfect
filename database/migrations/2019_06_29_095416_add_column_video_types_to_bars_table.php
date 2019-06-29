<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVideoTypesToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->enum('video_type', ['none', 'youtube', 'vimeo', 'other'])->default('none')->after('sub_background_color');
            $table->string('content_youtube_url')->nullable()->after('video_type');
            $table->string('content_vimeo_url')->nullable()->after('content_youtube_url');
            $table->dropColumn('video');
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
            $table->dropColumn('video_type');
            $table->dropColumn('content_youtube_url');
            $table->dropColumn('content_vimeo_url');
            $table->boolean('video')->after('sub_background_color')->default(0);
        });
    }
}
