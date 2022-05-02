<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class FilmsRepository {

  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function getAll() {
    $conn = $this->em->getConnection();
    $sql = '
        SELECT f.* FROM films f
        ORDER BY f.id_film
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery();
    return $resultSet->fetchAllAssociative();
  }

  public function getAllTitleAndImage() {
    $conn = $this->em->getConnection();
    $sql = '
        SELECT f.titre, f.affiche FROM films f
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery();
    return $resultSet->fetchAllAssociative();
  }

  public function getPopular() {
    $conn = $this->em->getConnection();
    $sql = '
        SELECT f.* FROM films f
        WHERE f.a_la_une = 1
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery();
    return $resultSet->fetchAllAssociative();
  }

  public function getOneById($id) {
    $conn = $this->em->getConnection();
    $sql = '
        SELECT f.* FROM films f
        WHERE f.id_film = :filmId
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'filmId' => $id
    ]);
    return $resultSet->fetchAssociative();
  }

  public function getBySearch($search) {
    $conn = $this->em->getConnection();
    $sql = "
        SELECT f.titre FROM films f
        WHERE UPPER(f.titre) LIKE UPPER(:search)
        UNION
        SELECT CONCAT(a.prenom, ' ', a.nom) FROM acteurs a
        WHERE UPPER(a.nom) LIKE UPPER(:search)
        OR UPPER(a.prenom) LIKE UPPER(:search)
    ";
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'search' => '%'.$search.'%'
    ]);
    return $resultSet->fetchAllAssociative();
  }

  public function getBySearchFilm($search) {
    $conn = $this->em->getConnection();
    $sql = "
        SELECT f.* FROM films f
        WHERE UPPER(f.titre) LIKE UPPER(:search)
    ";
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'search' => '%'.$search.'%'
    ]);
    return $resultSet->fetchAllAssociative();
  }
}