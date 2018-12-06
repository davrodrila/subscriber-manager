<?php

use App\Field;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'subscriber_id' => \App\Subscriber::all()->random()->id,
        'type_id' => \App\Type::all()->random()->id,
    ];
});
