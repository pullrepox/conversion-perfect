<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOptContentToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->text('sub_headline')->after('opt_content')->nullable();
            $table->string('sub_headline_color', 20)->after('sub_headline')->nullable();
            $table->string('sub_background_color', 20)->after('sub_headline_color')->nullable();
            $table->enum('media', ['none', 'video', 'online_image', 'upload_image'])->after('sub_background_color')->default('none');
            $table->enum('media_location', ['left', 'right', 'below_text'])->after('media')->default('left');
            $table->string('video_url')->after('media_location')->nullable();
            $table->string('image_url')->after('video_url')->nullable();
            $table->string('upload_image')->after('image_url')->nullable();
            $table->boolean('video_auto_play')->after('upload_image')->default(0);
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
            $table->dropColumn('sub_headline');
            $table->dropColumn('sub_headline_color');
            $table->dropColumn('sub_background_color');
            $table->dropColumn('media');
            $table->dropColumn('media_location');
            $table->dropColumn('video_url');
            $table->dropColumn('image_url');
            $table->dropColumn('upload_image');
            $table->dropColumn('video_auto_play');
        });
    }
}
