<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'AAA',
            'email' => 'aaa@aaaa',
            'password' => '12345678'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'BBB',
            'email' => 'bbb@bbbb',
            'password' => '12345678'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'CCC',
            'email' => 'ccc@cccc',
            'password' => '12345678'
        ];
        DB::table('users')->insert($param);
    }
}
