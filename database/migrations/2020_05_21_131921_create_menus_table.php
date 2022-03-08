<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->tinyInteger('parent')->nullable();
            $table->string('label', 50)->nullable();
            $table->string('link', 100)->nullable();
            $table->string('icon', 50)->nullable();
            $table->boolean('status')->nullable();
            $table->integer('userid_created')->nullable();
            $table->integer('userid_modified')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
