<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('videos_progress', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50);
            $table->unsignedBigInteger('video_id');
            $table->integer('progress')->default(0);
            $table->boolean('finished')->default(false);
            $table->timestamp('date_modified')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('videoProgress');
    }
};
