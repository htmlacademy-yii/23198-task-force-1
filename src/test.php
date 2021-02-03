<?php
namespace Taskforce;

require_once __DIR__ . '/../vendor/autoload.php';

use Taskforce\base\Task;

$task = new Task(2, 1, 'status_new');

$action = $task->getAvailableAction('worker');
extract($action);
//var_dump($action);
//die;
//var_dump(extract($action));
//die;
assert(($ReplyAction::getName() === Task::ACTION_REPLY) && ($ReplyAction->checkRules($task, 2) === true), 'worker status new');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2) === true), 'worker status new');

$task->setStatus('status_work');
$action = $task->getAvailableAction('worker');
extract($action);
assert(($DeclineAction::getName() === Task::ACTION_DECLINE) && ($DeclineAction->checkRules($task, 2)), 'worker status work');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status work');

$task->setStatus('status_done');
$action = $task->getAvailableAction('worker');
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status done');

$task->setStatus('status_cancelled');
$action = $task->getAvailableAction('worker');
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status cancelled');

$task->setStatus('status_fail');
$action = $task->getAvailableAction('worker');
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 2)), 'worker status cancelled');


$task->setStatus('status_new');
$action = $task->getAvailableAction('client');
extract($action);
assert(($CancelAction::getName() === Task::ACTION_CANCEL) && ($CancelAction->checkRules($task, 1) === true), 'client status new');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1) === true), 'client status new');

$task->setStatus('status_work');
$action = $task->getAvailableAction('client');
extract($action);
assert(($DoneAction::getName() === Task::ACTION_DONE) && ($DoneAction->checkRules($task, 1) === true), 'client status new');
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1) === true), 'client status new');

$task->setStatus('status_done');
$action = $task->getAvailableAction('client');
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1)), 'client status done');

$task->setStatus('status_cancelled');
$action = $task->getAvailableAction('client');
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1)), 'client status cancelled');

$task->setStatus('status_fail');
$action = $task->getAvailableAction('client');
extract($action);
assert(($MessageAction::getName() === Task::ACTION_MESSAGE) && ($MessageAction->checkRules($task, 1)), 'client status cancelled');
