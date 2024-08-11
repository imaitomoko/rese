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
            'email' => 'aaa@aaaa.com',
            'password' => 'secret'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'BBB',
            'email' => 'bbb@bbbb.com',
            'password' => 'secret'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'CCC',
            'email' => 'ccc@cccc.com',
            'password' => 'secret'
        ];
        DB::table('users')->insert($param);
    }
}
