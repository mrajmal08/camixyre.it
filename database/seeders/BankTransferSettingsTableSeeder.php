<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BankTransferSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_transfer_settings')->insert([
            'account_name'   => 'Account Name',
            'account_number' => 'Account Number',
            'bank_name'      => 'Bank Name',
            'sort_code'      => 'Sort Code',
            'iban'           => 'Iban',
            'bic_swift'      => 'BIC / SWIFT',
            'message'        => 'For bank transfer please send the bank slip to info@example.com',
        ]);
    }
}
