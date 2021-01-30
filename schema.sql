-- -----------------------------------------------------
-- Если БД существует то удаляем ее
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `taskforce` ;

-- -----------------------------------------------------
-- Создаем БД
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `taskforce` DEFAULT CHARACTER SET `utf8` DEFAULT COLLATE `utf8_general_ci`;

-- -----------------------------------------------------
-- Выбираем БД
-- -----------------------------------------------------
USE `taskforce` ;

-- -----------------------------------------------------
-- Таблица `Категории`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categories` ;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL COMMENT 'Категория',
  `slug` VARCHAR (100) NOT NULL COMMENT 'Текстовый идентификатор'
);


-- -----------------------------------------------------
-- Таблица `Города`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cities`;

CREATE TABLE IF NOT EXISTS `cities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL COMMENT 'Город',
  `longitude` VARCHAR (255) NOT NULL COMMENT 'Долгота',
  `latitude` VARCHAR (255) NOT NULL COMMENT 'Широта'
);


-- -----------------------------------------------------
-- Таблица `Пользователи`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL COMMENT 'ФИО пользователя',
  `email` VARCHAR(100) NOT NULL COMMENT 'email пользователя',
  `city_id` INT UNSIGNED NOT NULL COMMENT 'id города пользователя',
  `birthday` DATE NULL COMMENT 'Дата рождения',
  `info` VARCHAR(1000) NULL COMMENT 'Информация о пользователе',
--   `avatar` INT UNSIGNED NULL COMMENT 'Фото пользователя',
  `role` ENUM('client', 'worker') NOT NULL DEFAULT 'client' COMMENT 'Роль пользователя',
  `password` VARCHAR(255) NOT NULL COMMENT 'Пароль пользователя',
  `phone` VARCHAR(11) NULL COMMENT 'Телефон',
  `skype` VARCHAR(50) NULL COMMENT 'Скайп',
  `telegram` VARCHAR(50) NULL COMMENT 'Телеграм',
  FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Задания`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tasks` ;

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_create` INT UNSIGNED NOT NULL COMMENT 'id пользователя',
  `freelancer` INT UNSIGNED NULL DEFAULT NULL COMMENT 'id исполнителя',
  `category_id` INT UNSIGNED NOT NULL COMMENT 'id категории',
  `status` ENUM('new', 'cancelled', 'work', 'done', 'fail') DEFAULT 'new' COMMENT 'статус задачи',
  `title` VARCHAR(255) NOT NULL COMMENT 'Заголовок задачи',
  `description` VARCHAR(1000) NOT NULL COMMENT 'Описание задачи',
  `create_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время создания объявления',
  `price` INT UNSIGNED NOT NULL COMMENT 'Стоимость работы',
  `deadline` DATETIME NOT NULL COMMENT 'Дата завершения задачи',
  `city_id` INT UNSIGNED NULL COMMENT 'id города',
  `longitude` VARCHAR (255) NULL COMMENT 'Долгота',
  `latitude` VARCHAR (255) NULL COMMENT 'Широта',
  INDEX `title_idx` (`title`),
  FULLTEXT INDEX `description_idx` (`description`),
  FOREIGN KEY (`user_create`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`freelancer`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Фотографии`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `photos` ;

CREATE TABLE IF NOT EXISTS `photos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL COMMENT 'id пользователя',
  `path` VARCHAR(500) NOT NULL COMMENT 'Путь до файла',
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Настройки`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `settings` ;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL COMMENT 'id пользователя',
  `contact_hide` BOOLEAN NOT NULL DEFAULT 0 COMMENT 'Видимость контактов',
  `profile_hide` BOOLEAN NOT NULL DEFAULT 0 COMMENT 'Видимость профиля',
  `new_message` BOOLEAN NOT NULL DEFAULT 0 COMMENT 'Уведомление о новых сообщениях',
  `action_task` BOOLEAN NOT NULL DEFAULT 0 COMMENT 'Уведомление о действиях по заданию',
  `new_review` BOOLEAN NOT NULL DEFAULT 0 COMMENT 'Уведомление о новом отзыве',
  UNIQUE INDEX `user_idx` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Специализация пользователя`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_specialization` ;

CREATE TABLE IF NOT EXISTS `users_specialization` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `user_id` INT UNSIGNED NOT NULL COMMENT 'id пользователя',
  `category_id` INT UNSIGNED NOT NULL COMMENT 'id категории',
  UNIQUE INDEX `user_spec_idx` (`user_id`, `category_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Файлы`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `files` ;

CREATE TABLE IF NOT EXISTS `files` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `task_id` INT UNSIGNED NOT NULL COMMENT 'id задания',
  `path` VARCHAR(100) NULL COMMENT 'Путь до файла',
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Избранное`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favorite` ;

CREATE TABLE IF NOT EXISTS `favorite` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL COMMENT 'id пользователя',
  `task_id` INT UNSIGNED NOT NULL COMMENT 'id задачи в избранном',
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Таблица `Отклики`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `callbacks` ;

CREATE TABLE IF NOT EXISTS `callbacks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `task_id` INT UNSIGNED NOT NULL COMMENT 'id задачи',
  `freelancer_id` INT UNSIGNED NOT NULL COMMENT 'id исполнителя',
  `text` VARCHAR(255) NULL COMMENT 'Текст отклика',
  `price` INT UNSIGNED NOT NULL COMMENT 'Цена исполнителя за работу',
  FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Рейтинги`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ratings` ;

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL COMMENT 'id пользователя',
  `freelancer_id` INT UNSIGNED NOT NULL COMMENT 'id исполнителя',
  `task_id` INT UNSIGNED NOT NULL COMMENT 'id задания',
  `review` TEXT COMMENT 'Текст отзыва',
  `rating` FLOAT UNSIGNED NULL COMMENT 'Рейтинг',
  UNIQUE INDEX `rating_idx` (`user_id`, `freelancer_id`, `task_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- -----------------------------------------------------
-- Таблица `Сообщения`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `messages` ;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `from_user_id` INT UNSIGNED NOT NULL COMMENT 'id отправителя',
  `to_user_id` INT UNSIGNED NOT NULL COMMENT 'id получателя',
  `task_id` INT UNSIGNED NOT NULL COMMENT 'id задания',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `message` VARCHAR(1000) NOT NULL COMMENT 'Текст сообщения',
  FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);
