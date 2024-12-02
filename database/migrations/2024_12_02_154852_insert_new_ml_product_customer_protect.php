<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertNewMlProductCustomerProtect extends Migration
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
                'name' => 'coi_c',
                'parent' => 1,
                'label' => 'Customer Protect 20',
                'link' => '/transactions/coi_c',
                'icon' => null,
                'status' => 1,
                'userid_created' => 1,
                'userid_modified' => 1,
                'created_at' => now(),
                'updated_at' => now(), 
            ]
        );

        DB::table('insuran_prices')->insert(
            [
                'coi_type' => 'Customer Protect 20',
                'price' => 20.00,
                'status' => 1,
                'userid_created' => 1,
                'userid_modified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('settings')->insert([
            'name' => 'customer_protect',
            'value' => 'MM-03-24-CB-000469',
            'deleted_at' => null,
            'user_created' => 1,
            'user_modified' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu')
            ->whereIn('name', ['coi_ao','coi_r','coi_dt','coi_bf','coi_a','coi_b','coi_d','coi_m'])
            ->update(['status' => false]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menu')->where('name', 'coi_c')->delete();
        DB::table('insuran_prices')->where('coi_type', 'Customer Protect 20')->delete();
        DB::table('settings')->where('name', 'customer_protect')->delete();
        DB::table('menu')->whereIn('name', ['coi_ao','coi_r','coi_dt','coi_bf','coi_a','coi_b','coi_d','coi_m'])->update(['active' => true]);
    }
}
