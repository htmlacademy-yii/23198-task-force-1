<?php

namespace Taskforce\Test;
require_once __DIR__ . '/../../vendor/autoload.php';

use Taskforce\BusinessLogic\Task as Task;

$task = new Task(2, 1, 'status_new');

//$task->setStatus('status_new');
$action = $task->getAvailableAction('worker');
assert(($action[0]::getName() === Task::ACTION_REPLY) && ($action[0]->checkRules($task, 2) === true), 'worker status new');
assert(($action[1]::getName() === Task::ACTION_MESSAGE) && ($action[1]->checkRules($task, 2) === true), 'worker status new');

$task->setStatus('status_work');
$action = $task->getAvailableAction('worker');
assert(($action[0]::getName() === Task::ACTION_DECLINE) && ($action[0]->checkRules($task, 2)), 'worker status work');
assert(($action[1]::getName() === Task::ACTION_MESSAGE) && ($action[1]->checkRules($task, 2)), 'worker status work');

$task->setStatus('status_done');
$action = $task->getAvailableAction('worker');
assert(($action[0]::getName() === Task::ACTION_MESSAGE) && ($action[0]->checkRules($task, 2)), 'worker status done');

$task->setStatus('status_cancelled');
$action = $task->getAvailableAction('worker');
assert(($action[0]::getName() === Task::ACTION_MESSAGE) && ($action[0]->checkRules($task, 2)), 'worker status cancelled');

$task->setStatus('status_fail');
$action = $task->getAvailableAction('worker');
assert(($action[0]::getName() === Task::ACTION_MESSAGE) && ($action[0]->checkRules($task, 2)), 'worker status cancelled');


$task->setStatus('status_new');
$action = $task->getAvailableAction('client');
assert(($action[0]::getName() === Task::ACTION_CANCEL) && ($action[0]->checkRules($task, 1) === true), 'client status new');
assert(($action[1]::getName() === Task::ACTION_MESSAGE) && ($action[1]->checkRules($task, 1) === true), 'client status new');

$task->setStatus('status_work');
$action = $task->getAvailableAction('client');
assert(($action[0]::getName() === Task::ACTION_DONE) && ($action[0]->checkRules($task, 1) === true), 'client status new');
assert(($action[1]::getName() === Task::ACTION_MESSAGE) && ($action[1]->checkRules($task, 1) === true), 'client status new');

$task->setStatus('status_done');
$action = $task->getAvailableAction('client');
assert(($action[0]::getName() === Task::ACTION_MESSAGE) && ($action[0]->checkRules($task, 1)), 'client status done');

$task->setStatus('status_cancelled');
$action = $task->getAvailableAction('client');
assert(($action[0]::getName() === Task::ACTION_MESSAGE) && ($action[0]->checkRules($task, 1)), 'client status cancelled');

$task->setStatus('status_fail');
$action = $task->getAvailableAction('client');
assert(($action[0]::getName() === Task::ACTION_MESSAGE) && ($action[0]->checkRules($task, 1)), 'client status cancelled');
