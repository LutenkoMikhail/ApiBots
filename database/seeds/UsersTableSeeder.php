<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = new User();
        $userAdmin->name='ADMIN';
        $userAdmin->email='1@1';
        $userAdmin->email_verified_at=now();
        $userAdmin->password='$2y$10$c5bAFWlo54OvTuojqQ0F4.p5dsynQ61zQMu8VcRGtgJbFQ.db8B72';
        $userAdmin->remember_token=Str::random(10);
        $userAdmin->save();;

        factory(User::class,4)->create();
    }
}
