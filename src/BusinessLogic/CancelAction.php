<?php


namespace Taskforce\BusinessLogic;


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
