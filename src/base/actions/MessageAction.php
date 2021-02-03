<?php


namespace Taskforce\base\actions;

use Taskforce\base\Task;

class MessageAction extends AbstractAction
{

    public static function getName(): string
    {
        return 'action_message';
    }

    public function checkRules(Task $task, int $userId): bool
    {
        return $task->getWorkerId() === $userId || $task->getClientId() === $userId;
    }
}
