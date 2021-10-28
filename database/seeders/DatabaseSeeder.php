<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Admin User Factory
        \App\Models\Admin::factory()->create();

        // Run Seeders
        $this->call([
            CurrenciesTableSeeder::class,
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            SettingsTableSeeder::class,
            BraintreeSettingsTableSeeder::class,
            StripeSettingsTableSeeder::class,
            PayPalSettingsTableSeeder::class,
            ProductTableSeeder::class,
            BankTransferSettingsTableSeeder::class,
            // VariationTableSeeder::class,
            // AttributeTableSeeder::class,
        ]);
    }
}
