<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RoomService;

class RoomController extends AbstractController
{
    /**
     * @Route("/room/{id}", methods={"GET"} )
     */
    public function findOneById($id, RoomService $roomService)
    {
        $room = $roomService->findOneById($id);

        if(empty($room)){
            throw $this->createNotFoundException('The room does not exist');
        };

        return $this->json($room);
    }

    /**
     * @Route("/room", methods={"GET"} )
     */
    public function list(RoomService $roomService)
    {
        $rooms = $roomService->list();

        return $this->json($rooms);
    }
}
