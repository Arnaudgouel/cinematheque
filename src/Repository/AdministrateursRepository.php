<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class AdministrateursRepository {

  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function getCredentials($email) {
    $conn = $this->em->getConnection();
    $sql = '
      SELECT admin.password FROM administrateurs admin
      WHERE admin.email = :email
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'email' => $email,
    ]);
    return $resultSet->fetchOne();
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
    return $resultSet->fetchAssociative();
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
    return $resultSet->rowCount() >= 1;
  }

  public function update($nom, $prenom, $password, $email) :bool {
    $conn = $this->em->getConnection();
    $sql = '
      UPDATE administrateurs 
      SET nom = :nom, prenom = :prenom, password = :password
      WHERE email = :email
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'nom' => $nom,
      'prenom' => $prenom,
      'password' => $password,
      'email' => $email
    ]);
    return $resultSet->rowCount() >= 1;
  }

  public function delete($email) :bool {
    $conn = $this->em->getConnection();
    $sql = '
      DELETE FROM administrateurs 
      WHERE email = :email
    ';
    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery([
      'email' => $email
    ]);
    return $resultSet->rowCount() >= 1;
  }
}