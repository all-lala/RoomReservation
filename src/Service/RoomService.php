<?php

namespace App\Service;

use App\Repository\RoomRepository;

class RoomService
{

  /**
   * @var RoomRepository
   */
  private $roomRepository;

  public function __construct(RoomRepository $roomRepository){
    $this->roomRepository = $roomRepository;
  }

  public function findOneById($id) {
    return $this->roomRepository->findOneById($id);
  }

  public function list() {
    return $this->roomRepository->findAll();
  }
}