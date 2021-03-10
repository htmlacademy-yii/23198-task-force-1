<?php
$faker = Faker\Factory::create('ru_RU');

return [
    'user_id' => $faker->randomElement([1, 3, 5]),
    'freelancer_id' => $faker->randomElement([2, 4, 6, 8, 10]),
];
