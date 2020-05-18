<?php

namespace Taskforce;

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

    private $status;

    private $workerId;
    private $clientId;

    public  function  __construct($worker, $client)
    {
        $this->workerId = $worker;
        $this->clientId = $client;
    }

    public function getStatusesList() : array
    {
       return [
           self::STATUS_NEW => 'Новое',
           self::STATUS_CANCELLED => 'Отмененно',
           self::STATUS_WORK => 'В работе',
           self::STATUS_DONE => 'Выполнено',
           self::STATUS_FAIL => 'Провалено'
       ];
    }

    public function getActionsList() : array
    {
       return [
           self::ACTION_CANCEL => 'Отменить',
           self::ACTION_REPLY => 'Откликнуться',
           self::ACTION_DONE => 'Выполнено',
           self::ACTION_DECLINE => 'Отказаться'
       ];
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getNextStatus(string $action) : string
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
                return null;
        }
    }



    public function getAvailableAction($isClient = false) : string
    {
        if ($isClient) {
            return $this->getAvailableActionClient();
        }
        return $this->getAvailableActionWorker();
    }

    private function getAvailableActionWorker() : string
    {
        return null;
    }

    private function getAvailableActionClient() : string
    {
        return null;
    }
}
