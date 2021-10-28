<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->insert([
            'key'     => 10293,
            'name_en' => "ATTR En",
            'name_it' => "ATTR It",
            'name_fr' => "ATTR Fr",
            'name_es' => "ATTR Es",
            'name_de' => "ATTR De",
            'price'   => 5,
            'images'  => "1617346542.png"
        ]);
        DB::table('attributes')->insert([
            'key'     => 10293,
            'name_en' => "ATTR En",
            'name_it' => "ATTR It",
            'name_fr' => "ATTR Fr",
            'name_es' => "ATTR Es",
            'name_de' => "ATTR De",
            'price'   => 6,
            'images'  => "1617346542.png"
        ]);
        DB::table('attributes')->insert([
            'key'     => 10294,
            'name_en' => "ATTR En",
            'name_it' => "ATTR It",
            'name_fr' => "ATTR Fr",
            'name_es' => "ATTR Es",
            'name_de' => "ATTR De",
            'price'   => 0,
            'images'  => "1617346542.png"
        ]);
        DB::table('attributes')->insert([
            'key'     => 10294,
            'name_en' => "ATTR En",
            'name_it' => "ATTR It",
            'name_fr' => "ATTR Fr",
            'name_es' => "ATTR Es",
            'name_de' => "ATTR De",
            'price'   => 10,
            'images'  => "1617346542.png"
        ]);
    }
}
