<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'model' => $faker->name,
        'view' => $faker->name,
        'controller' => $faker->name,
        'note' => $faker->name,
    ];
});
