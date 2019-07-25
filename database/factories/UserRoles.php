<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserRole;
use Faker\Generator as Faker;

$factory->define(App\UserRole::class, function (Faker $faker) {
    return [
        //
        'user_id' => function(){
            return App\User::all()->random();
        },
        'role_id' => function(){
            return App\Role::all()->random();
        },
    ];
});
