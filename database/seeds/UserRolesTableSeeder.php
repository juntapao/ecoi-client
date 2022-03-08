<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('user_roles')->insert([
            'id' => Str::random(10),
            'role_name' => Str::random(10).'@gmail.com',
            'access' => Hash::make('password'),
            'status' => Hash::make('password'),
            'userid_created' => Hash::make('password'),
            'userid_modified' => Hash::make('password'),
            'created_at' => Hash::make('password'),
            'updated_at' => Hash::make('password'),
        ]);
    }
}
