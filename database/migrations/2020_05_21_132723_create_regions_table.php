<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('region_name', 50)->nullable();
            $table->string('region_manager', 50)->nullable(); 
            $table->boolean('status')->default(1);
            $table->integer('userid_created')->default(1);
            $table->integer('userid_modified')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
