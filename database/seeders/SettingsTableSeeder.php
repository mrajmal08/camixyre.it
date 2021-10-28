<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            "currency"                    => "EUR",
            "use_integer_prices"          => 0,
            "use_currency_symbol"         => 1,
            "comma_is_decimal_separator"  => 1,
            "enable_braintree"            => 0,
            "enable_paypal_in_bt"         => 0,
            "enable_stripe"               => 0,
            "enable_paypal_smart"         => 1,
            "enable_pp_smart_card"        => 1,
            "enable_pp_smart_credit"      => 1,
            "enable_pp_smart_bancontact"  => 1,
            "enable_pp_smart_blik"        => 1,
            "enable_pp_smart_eps"         => 1,
            "enable_pp_smart_giropay"     => 1,
            "enable_pp_smart_ideal"       => 1,
            "enable_pp_smart_mercadopago" => 1,
            "enable_pp_smart_mybank"      => 1,
            "enable_pp_smart_p24"         => 1,
            "enable_pp_smart_sepa"        => 1,
            "enable_pp_smart_sofort"      => 1,
            "enable_pp_smart_venmo"       => 1,
            "enable_bank_transfer"        => 1,
            "enable_cod"                  => 1,
        ]);
    }
}
