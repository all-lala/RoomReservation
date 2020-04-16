<?php

namespace App\Service;

use App\Repository\BookingRepository;

class BookingService
{

  /**
   * @var BookingRepository
   */
  private $bookingRepository;

  public function __construct(BookingRepository $bookingRepository){
    $this->bookingRepository = $bookingRepository;
  }

  public function findOneById($id) {
    return $this->bookingRepository->findOneById($id);
  }

  public function list() {
    return $this->bookingRepository->findAll();
  }
}