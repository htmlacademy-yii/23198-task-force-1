<?php

namespace Taskforce\BusinessLogic;

require_once __DIR__ . '/../../vendor/autoload.php';

class Task
{
    const STATUS_NEW = 'status_new';
    const STATUS_CANCELLED = 'status_cancelled';
    const STATUS_WORK = 'status_work';
    const STATUS_DONE = 'status_done';
    const STATUS_FAIL = 'status_fail';

    const ACTION_CANCEL = 'action_cancel';
    const ACTION_REPLY = 'action_reply';
    const ACTION_DONE = 'action_done';
    const ACTION_DECLINE = 'action_decline';
    const ACTION_MESSAGE = 'action_message';

    private $status;

    private $workerId;
    private $clientId;

    private $actions = [
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_REPLY => 'Откликнуться',
        self::ACTION_DONE => 'Выполнено',
        self::ACTION_DECLINE => 'Отказаться',
        self::ACTION_MESSAGE => 'Написать сообщение'
    ];

    private $statuses = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELLED => 'Отмененно',
        self::STATUS_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено'
    ];

    private $availableAction = [
        'worker' => [
            self::STATUS_NEW => [ReplyAction::class, MessageAction::class],
            self::STATUS_WORK => [DeclineAction::class, MessageAction::class],
            self::STATUS_DONE => [MessageAction::class],
            self::STATUS_CANCELLED => [MessageAction::class],
            self::STATUS_FAIL => [MessageAction::class]
        ],
        'client' => [
            self::STATUS_NEW => [CancelAction::class, MessageAction::class],
            self::STATUS_WORK => [DoneAction::class, MessageAction::class],
            self::STATUS_DONE => [MessageAction::class],
            self::STATUS_CANCELLED => [MessageAction::class],
            self::STATUS_FAIL => [MessageAction::class]
        ]
    ];

    public function __construct($worker, $client, $status)
    {
        $this->workerId = $worker;
        $this->clientId = $client;
        $this->status =  array_key_exists($status, $this->getStatusesList()) ? $status : 'null';
    }

    public function getStatusesList(): array
    {
        return $this->statuses;
    }

    public function getActionsList(): array
    {
        return $this->actions;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getNextStatus(string $action)
    {
        switch ($action) {
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELLED;
                break;
            case self::ACTION_REPLY:
                return self::STATUS_WORK;
                break;
            case self::ACTION_DONE:
                return self::STATUS_DONE;
                break;
            case self::ACTION_DECLINE:
                return self::STATUS_FAIL;
                break;
            default:
                throw new \Exception ('action <b>' . $action . '</b> doesnt change task status');
        }
    }

    public function getWorkerId() : int {
        return $this->workerId;
    }

    public function getClientId() : int {
        return $this->clientId;
    }

    public function getAvailableAction(string $role)
    {
       $arr = [];
       $actions = array_key_exists($this->status, $this->availableAction[$role]) ? $this->availableAction[$role][$this->status] : [null];

       foreach ($actions as $action) {
           $arr[] = new $action();
       }
       return $arr;
    }

}
