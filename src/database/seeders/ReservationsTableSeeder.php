<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'shop_id' => 6,
            'date' => '2024/04/01',
            'time' => '14:30',
            'number' => 2,
        ];
        DB::table('reservations')->insert($param);
    }
}
