<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class VariationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variations')->insert([
            'key'            => 112233,
            'name'           => "Colors",
            'type'           => "color",
            'attributes_key' => 10293
        ]);
        DB::table('variations')->insert([
            'key'            => 112233,
            'name'           => "Sizes",
            'type'           => "size",
            'attributes_key' => 10294
        ]);
    }
}
