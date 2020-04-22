<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BookingService;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking/{id}", methods={"GET"} )
     */
    public function findOneById($id, BookingService $bookingService)
    {
        $booking = $bookingService->findOneById($id);

        if(empty($booking)){
            throw $this->createNotFoundException('The booking does not exist');
        };

        return $this->json($booking);
    }

    /**
     * @Route("/booking", methods={"GET"} )
     */
    public function list(BookingService $bookingService)
    {
        $bookings = $bookingService->list();

        return $this->json($bookings);
    }

    /**
     * @Route("/booking", methods={"POST"} )
     */
    public function add(Request $request, BookingService $bookingService)
    {
    }
}
