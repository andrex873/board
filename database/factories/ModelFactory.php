<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Board\Database\Entities\Board::class, function (Faker\Generator $faker) {
    return [
        'secure_id' => generate_secure_id(),
        'name' => $faker->name,
    ];
});

$factory->define(Board\Database\Entities\Note::class, function (Faker\Generator $faker) {
    return [
        'secure_id' => generate_secure_id(),
        'board_id' => Board\Database\Entities\Board::all()->random()->id,
        'type' => $faker->randomElement(['WELL', 'WRON', 'AITEM']),
        'body' => $faker->paragraph(rand(2, 5)),
        'votes' => rand(0, 25),
    ];
});
