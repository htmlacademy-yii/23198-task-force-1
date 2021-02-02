<?php


namespace Taskforce\BusinessLogic;


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
