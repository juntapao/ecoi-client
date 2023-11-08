<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertNewInsurancePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('insuran_prices')->insert(
            [
                'coi_type' => 'Family Protect Ten',
                'price' => 10.00,
                'status' => 1,
                'userid_created' => 1,
                'userid_modified' => 1,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ]
        );
        DB::table('insuran_prices')->insert(
            [
                'coi_type' => 'Pinoy Protect Five',
                'price' => 5.00,
                'status' => 1,
                'userid_created' => 1,
                'userid_modified' => 1,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
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
        DB::table('insuran_prices')->where('coi_type', 'Family Protect Ten')->delete();
        DB::table('insuran_prices')->where('coi_type', 'Pinoy Protect Five')->delete();
    }
}
