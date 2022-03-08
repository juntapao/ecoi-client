<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranPricesTable extends Migration
{
    public function up()
    {
        Schema::create('insuran_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coi_type', 50)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('status')->nullable();
            $table->integer('userid_created')->nullable();
            $table->integer('userid_modified')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('insuran_prices');
    }
}
