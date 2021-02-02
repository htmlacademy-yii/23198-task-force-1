<?php


namespace Taskforce\BusinessLogic;


class DoneAction extends AbstractAction
{

    public static function getName(): string
    {
        return 'action_done';
    }

    public function checkRules(Task $task, int $userId): bool
    {
        return $task->getStatus() === Task::STATUS_WORK &&
        $task->getClientId() === $userId;
    }
}
