<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        'admin_name' => 'tom',
        'email' => 'tom@example.com',
        'password' => Hash::make('secret'),
        ];
        DB::table('admins')->insert($param);
        //
    }
}
