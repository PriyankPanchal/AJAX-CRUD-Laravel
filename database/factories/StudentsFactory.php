<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Students;
use Faker\Generator as Faker;

$factory->define(Students::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'contact_number' => $faker->word,
        'profile_image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
