<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;


class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory(1)->create();
    }
}
