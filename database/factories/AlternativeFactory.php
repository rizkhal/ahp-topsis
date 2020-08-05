<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Alternative;
use Faker\Generator as Faker;

$factory->define(Alternative::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'nilai' => rand(1, 9),
    ];
});
