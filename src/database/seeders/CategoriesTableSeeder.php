<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category' => '寿司'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'category' => '焼肉'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'category' => '居酒屋'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'category' => 'イタリアン'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'category' => 'ラーメン'
        ];
        DB::table('categories')->insert($param);
        //
    }
}
