<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'matricule' => $faker->numberBetween($min = 2015, $max = 2018).$faker->numberBetween($min = 1, $max = 100),
        'nom'	=> $faker->lastName(),
        'postnom' => $faker->lastName(),
        'prenom' => $faker->firstName($gender=null|'male'|'female'),
        'idauditoires' => $faker->numberBetween($min=1, $max=25),
    ];
});
