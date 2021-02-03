<?php


namespace Taskforce\base\actions;

use Taskforce\base\Task;

abstract class AbstractAction
{
    public static function getActionName() : string {
        return substr(strrchr(static::class, "\\"), 1);
    }

    abstract public static function getName() : string;

    abstract public function checkRules(Task $task, int $userId) : bool;
}
