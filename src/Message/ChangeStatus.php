<?php

namespace App\Message;

class ChangeStatus
{
    /**
     * @var int
     */
    private $taskId;

    /**
     * @var int
     */
    private $done;

    /**
     * ChangeStatus constructor.
     * @param int $taskId
     * @param int $done
     */
    public function __construct(int $taskId, int $done)
    {
        $this->taskId = $taskId;
        $this->done = $done;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @return int
     */
    public function isDone(): int
    {
        return $this->done;
    }
}
