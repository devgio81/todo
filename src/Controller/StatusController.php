<?php

namespace App\Controller;

use App\Message\ChangeStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/api/tasks/status/{id}/{status}")
     * @param MessageBusInterface $bus
     * @param int $id
     * @param bool $status
     */
    public function index(MessageBusInterface $bus, int $id, int $status)
    {
        $bus->dispatch(new ChangeStatus($id, $status));

        return new Response();
    }
}


