<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PeopleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PeopleController extends AbstractController
{
    /**
     * @Route("/people/{id}", methods={"GET"} )
     * 
     * @param int $id
     * @param PeopleService $peopleService
     * 
     * @return JsonResponse
     */
    public function findOneById($id, PeopleService $peopleService)
    {
        $people = $peopleService->findOneById($id);

        if(empty($people)){
            throw $this->createNotFoundException('The people does not exist');
        };

        return $this->json($people);
    }

    /**
     * @Route("/people", methods={"GET"} )
     * 
     * @param PeopleService $peopleService
     * 
     * @return JsonResponse
     */
    public function list(PeopleService $peopleService)
    {
        $peoples = $peopleService->list();

        return $this->json($peoples);
    }

    /**
     * @Route("/people", methods={"POST"} )
     * 
     * @param Request $request
     * @param PeopleService $peopleService
     * 
     * @return JsonResponse
     */
    public function add(Request $request, PeopleService $peopleService)
    {
        $people = json_decode($request->getContent());
        return $this->json($peopleService->add($people));
    }

    /**
     * @Route("/people/{id}", methods={"PATCH"} )
     * 
     * @param int $id
     * @param Request $request
     * @param PeopleService $peopleService
     * 
     * @return JsonResponse
     */
    public function update($id,Request $request, PeopleService $peopleService)
    {
        $people = json_decode($request->getContent());

        return $this->json($peopleService->update($people));
    }
    
    /**
     * @Route("/people/{id}", methods={"DELETE"} )
     *
     * @param int $id
     * @param PeopleService $peopleService
     *
     * @return JsonResponse
     */
    public function delete($id, PeopleService $peopleService)
    {
        $peopleService->delete($id);
        return $this->json('');
    }
}
