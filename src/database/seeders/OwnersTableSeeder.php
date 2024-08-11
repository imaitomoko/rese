<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        'owner_name' => 'hope',
        'email' => 'hope@example.com',
        'password' => Hash::make('secret')
        ];
        DB::table('owners')->insert($param);
        //
    }
}
