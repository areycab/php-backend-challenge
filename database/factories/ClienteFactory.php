<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellidos' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'telefono' => str_replace("+34", "",str_replace("-", "", str_replace(" ","",$faker->unique()->mobileNumber))),
        /*'created_at' => now(),
        'updated_at' => now(),*/
    ];
});
