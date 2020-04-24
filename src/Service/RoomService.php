<?php

namespace App\Service;

use App\Repository\RoomRepository;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;

class RoomService
{
  /**
   * @var RoomRepository
   */
    private $roomRepository;
    
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(RoomRepository $roomRepository, EntityManagerInterface $em){
    $this->roomRepository = $roomRepository;
    $this->em = $em;
  }

  /**
   * Get one room
   * 
   * @param int $id
   * @return Room
   */
  public function findOneById($id) {
    return $this->roomRepository->findOneById($id);
  }

  /**
   * Get all rooms
   * 
   * @return Room[]
   */
  public function list() {
    return $this->roomRepository->findAll();
  }
  
  /**
   * Add one room
   * 
   * @param Object $room
   * @return Room
   */
  public function add($room) {
    $newRoom = new Room();
    $this->hydrateRoom($room, $newRoom);
    $this->em->persist($newRoom);
    $this->em->flush();
    return $newRoom;
  }

  /**
   * Update one room
   * 
   * @param Object $room
   * @return Room
   */
  public function update($room) {
      $updatedRoom = $this->findOneById($room->id);
      $this->hydrateRoom($room, $updatedRoom);
      $this->em->persist($updatedRoom);
      $this->em->flush();
      return $updatedRoom;
  }
  
  /**
   * Delete one room
   * 
   * @param int $id
   */
  public function delete($id) {
      $deletedRoom = $this->findOneById($id);
      $this->em->remove($deletedRoom);
      $this->em->flush();
  }
      
  private function hydrateRoom($room, &$updatedRoom) {
      $updatedRoom->setLib($room->lib);
      if(property_exists($room, 'desc') && !empty($room->desc)){
          $updatedRoom->setDesc($room->desc);
      }
      $updatedRoom->setCapacity($room->capacity);
  }
}