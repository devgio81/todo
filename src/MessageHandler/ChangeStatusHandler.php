<?php

namespace App\MessageHandler;

use App\Message\ChangeStatus;
use App\Repository\TaskRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ChangeStatusHandler implements MessageHandlerInterface
{

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * ChangeStatusHandler constructor.
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ChangeStatus $message
     */
    public function __invoke(ChangeStatus $message)
    {
        $repo = $this->repository->find($message->getTaskId());

        $repo->setIsDone((bool)$message->isDone());

        $this->repository->save($repo);
    }
}
