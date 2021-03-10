<?php

$faker = Faker\Factory::create('ru_RU');
return [
    'user_id' => $faker->randomElement([2, 4, 8, 10]),
    'category_id' => $faker->numberBetween($min = 1, $max = 8)
];
