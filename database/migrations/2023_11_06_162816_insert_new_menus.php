<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertNewMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('menu')->insert(
            [
                'name' => 'coi_dt',
                'parent' => 1,
                'label' => 'Family Protect Ten',
                'link' => '/transactions/coi_dt',
                'icon' => null,
                'status' => 1,
                'userid_created' => 1,
                'userid_modified' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('menu')->insert(
            [
                'name' => 'coi_bf',
                'parent' => 1,
                'label' => 'Pinoy Protect Five',
                'link' => '/transactions/coi_bf',
                'icon' => null,
                'status' => 1,
                'userid_created' => 1,
                'userid_modified' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menu')->where('name', 'coi_dt')->delete();
        DB::table('menu')->where('name', 'coi_bf')->delete();
    }
}
