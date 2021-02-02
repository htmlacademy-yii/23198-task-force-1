<?php


namespace Taskforce\BusinessLogic;


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
