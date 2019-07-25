<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(App\User::class,5)->create();
        factory(App\UserRole::class,1)->create();
        //factory(App\Model\Review::class,300)->create();
    }
}
