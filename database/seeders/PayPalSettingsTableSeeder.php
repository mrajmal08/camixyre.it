<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PayPalSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paypal_settings')->insert([
            'paypal_smart_environment'    => 'sandbox',
            'paypal_smart_sandbox_client' => '',
            'paypal_smart_sandbox_secret' => '',
        ]);
    }
}
