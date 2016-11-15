<?php

/**
 * Animal model factory
 */

$factory->define(ZooSim\Animal::class, function (Faker\Generator $faker) {
    return [
        'animal_id' => function () {
            return factory(Specie::class)->create()->id;
        },
        'current_health' => $faker->current_health,
        'isDead' => $faker->isDead
    ];
});
