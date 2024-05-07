<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
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
            'shop_id' => 5,
        ];
        DB::table('favorites')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 6,
        ];
        DB::table('favorites')->insert($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 3,
        ];
        DB::table('favorites')->insert($param);
        //
    }
}
