<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('branch_name', 255);
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('code', 50);
            $table->smallInteger('area_id');
            $table->tinyInteger('status')->default(1);
            $table->integer('userid_created')->default(1);
            $table->integer('userid_modified')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
