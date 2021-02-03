<?php


namespace Taskforce\base\actions;

use Taskforce\base\Task;


class DeclineAction extends AbstractAction
{

    public static function getName(): string
    {
        return 'action_decline';
    }

    public function checkRules(Task $task, int $userId): bool
    {
        return $task->getStatus() === Task::STATUS_WORK &&
            $task->getWorkerId() === $userId;
    }
}
