<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PeopleService;

class PeopleController extends AbstractController
{
    /**
     * @Route("/people/{id}", methods={"GET"} )
     */
    public function findOneById($id, PeopleService $peopleService)
    {
        $people = $peopleService->findOneById($id);

        if(empty($people)){
            throw $this->createNotFoundException('The people does not exist');
        };

        return $this->json([
            'people' => $people,
        ]);
    }

    /**
     * @Route("/people", methods={"GET"} )
     */
    public function list(PeopleService $peopleService)
    {
        $peoples = $peopleService->list();

        return $this->json([
            'peoples' => $peoples,
        ]);
    }
}
