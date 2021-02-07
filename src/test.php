<?php
declare(strict_types=1);

namespace Taskforce;

require_once __DIR__ . '/../vendor/autoload.php';

use Taskforce\base\exceptions\RoleException;
use Taskforce\base\exceptions\StatusException;
use Taskforce\base\exceptions\UserException;
use Taskforce\base\Task;

try {
   $task = new Task(2, 1, 'status_new');
}
catch (UserException $e) {
    echo 'Ошибка с пользователем: ' . $e->getMessage();
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}

try {
    $action = $task->getAvailableAction('worker');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}

extract($action);
assert(($ReplyAction::getName() === Task::ACTION_REPLY) && ($ReplyAction->checkRules($task, 2) === true), 'worker status new');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2) === true), 'worker status new');

try {
    $task->setStatus('status_work');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('worker');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($DeclineAction::getName() === Task::ACTION_DECLINE) && ($DeclineAction->checkRules($task, 2)), 'worker status work');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status work');

try {
    $task->setStatus('status_done');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}

try {
    $action = $task->getAvailableAction('worker');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status done');

try {
    $task->setStatus('status_cancelled');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('worker');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status cancelled');

try {
    $task->setStatus('status_fail');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('worker');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status cancelled');

try {
    $task->setStatus('status_new');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('client');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($CancelAction::getName() === Task::ACTION_CANCEL) && ($CancelAction->checkRules($task, 1) === true), 'client status new');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1) === true), 'client status new');

try {
    $task->setStatus('status_work');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('client');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($DoneAction::getName() === Task::ACTION_DONE) && ($DoneAction->checkRules($task, 1) === true), 'client status new');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1) === true), 'client status new');

try {
    $task->setStatus('status_done');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('client');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1)), 'client status done');

try {
    $task->setStatus('status_cancelled');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('client');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1)), 'client status cancelled');

try {
    $task->setStatus('status_fail');
}
catch (StatusException $e) {
    echo 'Ошибка статуса: ' . $e->getMessage();
}
try {
    $action = $task->getAvailableAction('client');
}
catch (RoleException $e) {
    echo 'Ошибка роли пользователя: ' . $e->getMessage();
}
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1)), 'client status cancelled');
