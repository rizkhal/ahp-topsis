<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Criteria;
use Faker\Generator as Faker;

$factory->define(Criteria::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'bobot' => rand(1, 9),
        'type'  => rand(0, 1),
    ];
});
