<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hipoteca;
use Faker\Generator as Faker;

$factory->define(Hipoteca::class, function (Faker $faker) {

    $precio_compra = $faker->randomNumber(6);
    $porcentaje = $faker->numberBetween(20, 80);
    $ahorros = round($precio_compra * ($porcentaje / 100));
    $fecha = $faker->dateTimeThisMonth($max = 'now', $timezone = null);
    return [
        'ahorros_aportados' => $ahorros,
        'precio_compra' => $precio_compra,
        'porcentaje' => $porcentaje,
        'experto_id' => factory(App\Experto::class)->create(),
        'cliente_id' => factory(App\Cliente::class)->create(),
        'created_at' => $fecha,
        'updated_at' => $fecha
    ];
});
