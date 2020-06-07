<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Software Development', 'Business Development', 'Logistics', 'Marketing', 'Human Resources']),
        'description' => $faker->text(200)
    ];
});
