<?php

use App\Relationship;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',25);
            $table->boolean('status');
            $table->timestamps();
        });

        $relationships = ['LEGAL SPOUSE','CHILD/REN','FATHER','MOTHER','SIBLING','ESTATE'];
        foreach ($relationships as $relationship) {
            $relation = new Relationship;
            $relation->name = $relationship;
            $relation->status = true;
            $relation->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
