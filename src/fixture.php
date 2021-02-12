<?php
namespace Taskforce;

require_once __DIR__ . '/../vendor/autoload.php';

use Taskforce\base\exceptions\OutFileException;
use Taskforce\base\exceptions\SourceFileException;
use Taskforce\base\utils\CsvToSQLConverter;

try {
    $cities = new CsvToSQLConverter(__DIR__ . '/../data/cities.csv', 'cities');
}catch (SourceFileException $e) {
    echo $e->getMessage();
}
try {
    $cities->export();
}catch (OutFileException $e) {
    echo $e->getMessage();
}

try {
    $cat = new CsvToSQLConverter(__DIR__ . '/../data/categories.csv', 'categories');
}catch (SourceFileException $e){
    echo $e->getMessage();
}
try {
    $cat->export();
}catch (OutFileException $e){
    echo $e->getMessage();
}

try {
    $opinions = new CsvToSQLConverter(__DIR__ . '/../data/opinions.csv', 'opinions');
}catch (SourceFileException $e){
    echo $e->getMessage();
}
try {
    $opinions->export();
}catch (OutFileException $e){
    echo $e->getMessage();
}

try {
    $profiles = new CsvToSQLConverter(__DIR__ . '/../data/profiles.csv', 'profiles');
}catch (SourceFileException $e){
    echo $e->getMessage();
}
try {
    $profiles->export();
}catch (OutFileException $e){
    echo $e->getMessage();
}

try {
    $replies = new CsvToSQLConverter(__DIR__ . '/../data/replies.csv', 'replies');
}catch (SourceFileException $e){
    echo $e->getMessage();
}
try {
    $replies->export();
}catch (OutFileException $e){
    echo $e->getMessage();
}

try {
    $tasks = new CsvToSQLConverter(__DIR__ . '/../data/tasks.csv', 'tasks');
}catch (SourceFileException $e){
    echo $e->getMessage();
}
try {
    $tasks->export();
}catch (OutFileException $e){
    echo $e->getMessage();
}

try {
    $users = new CsvToSQLConverter(__DIR__ . '/../data/users.csv', 'users');
}catch (SourceFileException $e){
    echo $e->getMessage();
}
try {
    $users->export();
}catch (OutFileException $e){
    echo $e->getMessage();
}
