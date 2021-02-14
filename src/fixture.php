<?php
namespace Taskforce;

require_once __DIR__ . '/../vendor/autoload.php';

use Taskforce\base\exceptions\OutFileException;
use Taskforce\base\exceptions\SourceFileException;
use Taskforce\base\utils\CsvToSQLConverter;


$cities = new CsvToSQLConverter(__DIR__ . '/../data/cities.csv', 'cities');
$cities->export();

$cat = new CsvToSQLConverter(__DIR__ . '/../data/categories.csv', 'categories');
$cat->export();

$opinions = new CsvToSQLConverter(__DIR__ . '/../data/opinions.csv', 'opinions');
$opinions->export();

$profiles = new CsvToSQLConverter(__DIR__ . '/../data/profiles.csv', 'profiles');
$profiles->export();

$replies = new CsvToSQLConverter(__DIR__ . '/../data/replies.csv', 'replies');
$replies->export();

$tasks = new CsvToSQLConverter(__DIR__ . '/../data/tasks.csv', 'tasks');
$tasks->export();

$users = new CsvToSQLConverter(__DIR__ . '/../data/users.csv', 'users');
$users->export();
