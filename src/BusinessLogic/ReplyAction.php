<?php


namespace Taskforce\BusinessLogic;


class ReplyAction extends AbstractAction
{

    public static function getName(): string
    {
        return 'action_reply';
    }

    public function checkRules(Task $task, int $userId): bool
    {
        return $task->getStatus() === Task::STATUS_NEW &&
            $task->getWorkerId() === $userId;
    }
}
