<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_all', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('images')->nullable();
            $table->integer('banner_id')->nullable()->comment('banner关联id');
            $table->integer('photo_wall_id')->nullable()->comment('photoWall关联id');
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
        Schema::dropIfExists('image_all');
    }
}
