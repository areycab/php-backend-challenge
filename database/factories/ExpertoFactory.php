<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Experto;
use Faker\Generator as Faker;

$factory->define(Experto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
    ];
});
