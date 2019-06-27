<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnContentVideoCodeInBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->boolean('video')->after('sub_background_color')->default(0);
            $table->text('video_code')->after('video')->nullable();
            $table->dropColumn('media');
            $table->dropColumn('media_location');
            $table->dropColumn('video_url');
            $table->dropColumn('image_url');
            $table->dropColumn('upload_image');
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
            $table->enum('media', ['none', 'video', 'online_image', 'upload_image'])->after('sub_background_color')->default('none');
            $table->enum('media_location', ['left', 'right', 'below_text'])->after('media')->default('left');
            $table->string('video_url')->after('media_location')->nullable();
            $table->string('image_url')->after('video_url')->nullable();
            $table->string('upload_image')->after('image_url')->nullable();
            $table->dropColumn('video');
            $table->dropColumn('video_code');
        });
    }
}
