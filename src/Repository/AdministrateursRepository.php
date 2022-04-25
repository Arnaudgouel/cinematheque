<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class AdministrateursRepository {

  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function getCredentials($email, $password) {
    $conn = $this->em->getConnection();
    $sql = '
      SELECT admin.email, admin.nom, admin.prenom FROM administrateurs admin
      WHERE admin.email = :email
      AND admin.password = :password
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'email' => $email,
      'password' => $password
    ]);
    return $resultSet->fetchAllAssociative();
  }

  public function getAll() {
    $conn = $this->em->getConnection();
    $sql = '
      SELECT admin.email, admin.nom, admin.prenom FROM administrateurs admin
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery();
    return $resultSet->fetchAllAssociative();
  }

  public function getOne($email) {
    $conn = $this->em->getConnection();
    $sql = '
      SELECT admin.email, admin.nom, admin.prenom FROM administrateurs admin
      WHERE admin.email = :email
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'email' => $email
    ]);
    return $resultSet->fetchAllAssociative();
  }

  public function add($email, $nom, $prenom, $password) {
    $conn = $this->em->getConnection();
    $sql = '
      INSERT INTO administrateurs (email, nom, prenom, password) VALUES
      (
        :email, :nom, :prenom, :password
      )
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'email' => $email,
      'nom' => $nom,
      'prenom' => $prenom,
      'password' => $password
    ]);
    return $resultSet->fetchAllAssociative();
  }

  public function update($email, $nom, $prenom, $password, $emailOld, $nomOld, $prenomOld) {
    $conn = $this->em->getConnection();
    $sql = '
      UPDATE administrateurs 
      SET email = :email, nom = :nom, prenom = :prenom, password = :password
      WHERE email = :emailOld
      AND nom = :nomOld
      AND prenom = :prenomOld
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'email' => $email,
      'nom' => $nom,
      'prenom' => $prenom,
      'password' => $password,
      'emailOld' => $emailOld,
      'nomOld' => $nomOld,
      'prenomOld' => $prenomOld
    ]);
    return $resultSet->fetchAllAssociative();
  }
}