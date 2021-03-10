<?php

//* @property int $user_create id пользователя
//* @property int|null $freelancer id исполнителя
//* @property int $category_id id категории
//* @property string|null $status статус задачи
//* @property string $title Заголовок задачи
//* @property string $description Описание задачи
//* @property string $create_at Время создания объявления
//* @property int $price Стоимость работы
//* @property string $deadline Дата завершения задачи
//* @property int|null $city_id id города
//* @property string|null $longitude Долгота
//* @property string|null $latitude Широта

$faker = Faker\Factory::create('ru_RU');

return [
    'user_create' => $faker->randomElement([1, 3, 4, 5, 7, 9]),
    'freelancer' => $faker->randomElement([2, 6, 8, 10, null]),
    'category_id' => $faker->numberBetween($min = 1, $max = 8),
    'status' => $faker->randomElement(['new', 'done', 'work']),
    'title' => $faker->text($maxNbChars = 50),
    'description' => $faker->text,
    'create_at' => $faker->dateTimeInInterval($startDate = '+ 3 hours', $interval = '+ 1 hours', $timezone = null)->format('Y-m-d H:i:s'),
    'price' => $faker->numberBetween($min = 1000, $max = 10000),
    'deadline' => $faker->dateTimeInInterval($startDate = '+ 3 days', $interval = '+ 5 days', $timezone = null)->format('Y-m-d H:i:s'),
    'city_id' => $faker->numberBetween($min = 1, $max = 1108),
    'longitude' => null,
    'latitude' => null
];
