<?php

/**
 * Specie model factory
 */

$factory->define(ZooSim\Specie::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'fatal_health_level' => $faker->fatal_health_level
    ];
});
