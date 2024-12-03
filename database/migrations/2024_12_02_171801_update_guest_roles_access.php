<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGuestRolesAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('user_roles')
        ->where('role_name', 'GUEST')
        ->update(['access' => 'coi_c,posted']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('user_roles')
        ->where('role_name', 'GUEST')
        ->update(['access' => 'coi_a,coi_b,coi_d,coi_r,coi_ao,coi_m,posted,coi_bf,coi_dt']);
    }
}
