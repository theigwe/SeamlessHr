<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'role' => $faker->jobTitle,
        'employment_date' => $faker->dateTimeBetween('-5 years', 'now', null),
        'salary' => $faker->numberBetween(18000, 300000),
        'status' => $faker->randomElement(['probation', 'sacked', 'dismissed', 'worker']),
        'salary_currency' => $faker->randomElement(['NGN', 'USD']),
        'staff_type' => $faker->randomElement(['contract', 'full time', 'part time'])
    ];
});
