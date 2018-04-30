<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('groups')->insert([
            'name' => 'Преподаватель',
        ]);
        DB::table('groups')->insert([
            'name' => 'Техник',
        ]);
    }
}
