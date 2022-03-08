<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50)->unique();
            $table->string('value', 50);
            $table->softDeletes();
            $table->integer('user_created')->default(1);
            $table->integer('user_modified')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
