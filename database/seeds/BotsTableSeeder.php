<?php

use App\Bot;
use Illuminate\Database\Seeder;

class BotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bot::class,12)->create();
    }
}
