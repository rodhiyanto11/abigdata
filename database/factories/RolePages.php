<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\RolePage::class, function (Faker $faker) {
    return [
        //
        'role_id' => function(){
            return App\Role::all()->random();
        },
        'page_id' => function(){
            return App\Page::all()->random();
        },
    ];
});
