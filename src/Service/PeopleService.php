<?php

namespace App\Service;

use App\Repository\PeopleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\People;

class PeopleService
{
  /**
   * @var PeopleRepository
   */
    private $peopleRepository;
    
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PeopleRepository $peopleRepository, EntityManagerInterface $em){
    $this->peopleRepository = $peopleRepository;
    $this->em = $em;
  }

  /**
   * Get one people
   * 
   * @param int $id
   * @return People
   */
  public function findOneById($id) {
    return $this->peopleRepository->findOneById($id);
  }

  /**
   * Get all peoples
   * 
   * @return People[]
   */
  public function list() {
    return $this->peopleRepository->findAll();
  }
  
  /**
   * Add one people
   * 
   * @param Object $people
   * @return People
   */
  public function add($people) {
    $newPeople = new People();
    $this->hydratePeople($people, $newPeople);
    $this->em->persist($newPeople);
    $this->em->flush();
    return $newPeople;
  }

  /**
   * Update one people
   * 
   * @param Object $people
   * @return People
   */
  public function update($people) {
      $updatedPeople = $this->findOneById($people->id);
      $this->hydratePeople($people, $updatedPeople);
      $this->em->persist($updatedPeople);
      $this->em->flush();
      return $updatedPeople;
  }
  
  /**
   * Delete one people
   * 
   * @param int $id
   */
  public function delete($id) {
      $deletedPeople = $this->findOneById($id);
      $this->em->remove($deletedPeople);
      $this->em->flush();
  }
      
  private function hydratePeople($people, &$updatedPeople) {
      $updatedPeople->setLastname($people->lastname);
      $updatedPeople->setFirstname($people->firstname);
  }
}