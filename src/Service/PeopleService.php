<?php

namespace App\Service;

use App\Repository\PeopleRepository;

class PeopleService
{

  /**
   * @var PeopleRepository
   */
  private $peopleRepository;

  public function __construct(PeopleRepository $peopleRepository){
    $this->peopleRepository = $peopleRepository;
  }

  public function findOneById($id) {
    return $this->peopleRepository->findOneById($id);
  }

  public function list() {
    return $this->peopleRepository->findAll();
  }
}