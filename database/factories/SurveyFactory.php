<?php

use Faker\Generator as Faker;

$factory->define(App\Survey::class, function (Faker $faker) {
    return [
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
    ];
});
