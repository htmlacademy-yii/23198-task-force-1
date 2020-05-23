<?php
namespace Taskforce\Test;

use Taskforce\Task as Task;

require_once __DIR__ . '/../src/Task.php';

$task = new Task(null, 1);

assert($task->getNextStatus('action_cancel') == Task::STATUS_CANCELLED, 'cancel action');
assert($task->getNextStatus('action_reply') == Task::STATUS_WORK, 'reply action');
assert($task->getNextStatus('action_done') == Task::STATUS_DONE, 'done action');
assert($task->getNextStatus('action_decline') == Task::STATUS_FAIL, 'decline action');
try {
    $task->getNextStatus('sample');
} catch (\Exception $e) {
    echo $e->getMessage();
}

$task->setStatus('status_new');
assert($task->getAvailableAction()[0] == Task::ACTION_REPLY, 'worker status new');
assert($task->getAvailableAction()[1] == Task::ACTION_MESSAGE, 'worker status new');

$task->setStatus('status_work');
assert($task->getAvailableAction()[0] == Task::ACTION_DECLINE, 'worker status work');
assert($task->getAvailableAction()[1] == Task::ACTION_MESSAGE, 'worker status work');

$task->setStatus('status_done');
assert($task->getAvailableAction()[0] == null, 'worker status done');

$task->setStatus('status_cancelled');
assert($task->getAvailableAction()[0] == null, 'worker status cancelled');

$task->setStatus('status_fail');
assert($task->getAvailableAction()[0]== null, 'worker status fail');


$task->setStatus('status_new');
assert($task->getAvailableAction(true)[0] == Task::ACTION_CANCEL, 'client status new');
assert($task->getAvailableAction(true)[1] == Task::ACTION_MESSAGE, 'client status new');

$task->setStatus('status_work');
assert($task->getAvailableAction(true)[0] == Task::ACTION_DONE, 'client status work');
assert($task->getAvailableAction(true)[1] == Task::ACTION_MESSAGE, 'client status work');

$task->setStatus('status_done');
assert($task->getAvailableAction(true)[0] == null, 'client status done');

$task->setStatus('status_cancelled');
assert($task->getAvailableAction(true)[0] == null, 'client status cancelled');

$task->setStatus('status_fail');
assert($task->getAvailableAction(true)[0] == null, 'client status fail');
