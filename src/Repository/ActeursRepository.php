<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class ActeursRepository {

  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function getAll() {
    $conn = $this->em->getConnection();
    $sql = '
        SELECT a.* FROM acteurs a
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery();
    return $resultSet->fetchAllAssociative();
  }

  public function getOneById($id) {
    $conn = $this->em->getConnection();
    $sql = '
        SELECT a.* FROM acteurs a
        WHERE a.id_acteur = :acteurId
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'acteurId' => $id
    ]);
    return $resultSet->fetchAllAssociative();
  }
}