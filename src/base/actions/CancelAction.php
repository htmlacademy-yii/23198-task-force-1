<?php


namespace Taskforce\base\actions;

use Taskforce\base\Task;


class CancelAction extends AbstractAction
{

    public static function getName(): string
    {
        return 'action_cancel';
    }

    public function checkRules(Task $task, int $userId): bool
    {
        return $task->getStatus() === Task::STATUS_NEW &&
            $task->getClientId() === $userId;
    }
}
