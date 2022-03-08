<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 75)->unique();
            $table->string('password', 255);
            $table->string('full_name', 100);
            $table->integer('branch_id')->default(0);
            $table->integer('role_id')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('userid_created')->default(1);
            $table->integer('userid_modified')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->index(['branch_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
