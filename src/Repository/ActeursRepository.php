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
    return $resultSet->fetchAssociative();
  }

  public function getBySearchActeur($search) {
    $conn = $this->em->getConnection();
    $sql = "
      SELECT a.* FROM acteurs a
      WHERE UPPER(a.nom) LIKE UPPER(:search)
      OR UPPER(a.prenom) LIKE UPPER(:search)
    ";
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'search' => '%'.$search.'%'
    ]);
    return $resultSet->fetchAllAssociative();
  }
}