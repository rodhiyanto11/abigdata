<?php

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
        // $this->call(UsersTableSeeder::class);
        //
        //factory(App\User::class,20)->create();
        //factory(App\Role::class,20)->create();
        factory(App\Page::class,20)->create();
        factory(App\RolePage::class,20)->create();
       // factory(App\UserRole::class,20)->create();
    }
}
