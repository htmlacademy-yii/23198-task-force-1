<?php


namespace Taskforce\BusinessLogic;


abstract class AbstractAction
{
    public static function getActionName() : string {
        return static::class;
    }

    abstract public static function getName() : string;

    abstract public function checkRules(Task $task, int $userId) : bool;
}
