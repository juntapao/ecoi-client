<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area_name', 50)->nullable();
            $table->string('area_manager', 50)->nullable();
            $table->smallInteger('region_id')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->integer('userid_created')->default(1);
            $table->integer('userid_modified')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
