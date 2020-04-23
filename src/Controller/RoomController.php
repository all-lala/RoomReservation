<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RoomService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoomController extends AbstractController
{
    /**
     * @Route("/room/{id}", methods={"GET"} )
     * 
     * @param int $id
     * @param RoomService $roomService
     * 
     * @return JsonResponse
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
     * 
     * @param RoomService $roomService
     * 
     * @return JsonResponse
     */
    public function list(RoomService $roomService)
    {
        $rooms = $roomService->list();

        return $this->json($rooms);
    }

    /**
     * @Route("/room", methods={"POST"} )
     * 
     * @param Request $request
     * @param RoomService $roomService
     * 
     * @return JsonResponse
     */
    public function add(Request $request, RoomService $roomService)
    {
        $room = json_decode($request->getContent());
        return $this->json($roomService->add($room));
    }

    /**
     * @Route("/room/{id}", methods={"PATCH"} )
     * 
     * @param int $id
     * @param Request $request
     * @param RoomService $roomService
     * 
     * @return JsonResponse
     */
    public function update($id,Request $request, RoomService $roomService)
    {
        $room = json_decode($request->getContent());

        return $this->json($roomService->update($room));
    }
    
    /**
     * @Route("/room/{id}", methods={"DELETE"} )
     *
     * @param int $id
     * @param RoomService $roomService
     *
     * @return JsonResponse
     */
    public function delete($id, RoomService $roomService)
    {
        $roomService->delete($id);
        return $this->json('');
    }
}
