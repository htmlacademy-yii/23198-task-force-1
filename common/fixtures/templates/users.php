<?php
/**
 * @var $index integer
 */
$faker = Faker\Factory::create('ru_RU');
return [
    'name' => $faker->name,
    'email' => $faker->email,
    'city_id' => $faker->numberBetween($min = 1, $max = 1108),
    'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'info' => $faker->paragraph,
    'role' => $faker->randomElement(['client', 'worker']),
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'skype' => $faker->userName,
    'telegram' => $faker->userName,
    'last_visit' => $faker->dateTimeInInterval($startDate = '+ 3 hours', $interval = '+ 1 hours', $timezone = null)->format('Y-m-d H:i:s')
];
