<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertNewSettingsProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::table('settings')->insert([
        //     'name' => 'family_protect_ten',
        //     'value' => 'MM-03-23-CB-000548',
        //     'deleted_at' => null,
        //     'user_created' => 1,
        //     'user_modified' => 1,
        //     'created_at' => Carbon\Carbon::now(),
        //     'updated_at' => Carbon\Carbon::now(),
        // ]);
        // DB::table('settings')->insert([
        //     'name' => 'pinoy_protect_five',
        //     'value' => 'MM-03-23-CB-000547',
        //     'deleted_at' => null,
        //     'user_created' => 1,
        //     'user_modified' => 1,
        //     'created_at' => Carbon\Carbon::now(),
        //     'updated_at' => Carbon\Carbon::now(),
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->where('name', 'family_protect_ten')->delete();
        DB::table('settings')->where('name', 'pinoy_protect_five')->delete();
    }
}
