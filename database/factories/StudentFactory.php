<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name'    => $faker->name,
        'nis'     => $faker->randomNumber(9),
        'gender'  => rand(1, 2),
        'address' => $faker->address,
    ];
});
