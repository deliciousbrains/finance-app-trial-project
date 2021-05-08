<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'wladislavk',
            'email' => 'wladislavk@gmail.com',
            'password' => bcrypt('123456'),
            'api_token' => 'token',
        ]);
        DB::table('entries')->insert([
            'user_id' => 1,
            'label' => 'Opening Balance',
            'value' => 3000,
            'date' => '2020-05-11 10:00:00',
        ]);
        $date = Carbon::now()->subDay()->format('Y-m-d');
        DB::table('entries')->insert([
            'user_id' => 1,
            'label' => 'Car Insurance',
            'value' => -500,
            'date' => $date . ' 08:00:00',
        ]);
        $date = Carbon::now()->format('Y-m-d');
        DB::table('entries')->insert([
            'user_id' => 1,
            'label' => 'Lottery Win',
            'value' => 10,
            'date' => $date . ' 09:05:00',
        ]);
        DB::table('entries')->insert([
            'user_id' => 1,
            'label' => 'Groceries',
            'value' => 60,
            'date' => '2020-05-11 22:55:00',
        ]);
    }
}
