<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acteurs
 *
 * @ORM\Table(name="acteurs")
 * @ORM\Entity
 */
class Acteurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_acteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="acteurs_id_acteur_seq", allocationSize=1, initialValue=1)
     */
    private $idActeur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=250, nullable=true)
     */
    private $photo = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="biographie", type="text", nullable=true)
     */
    private $biographie;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="naissance", type="date", nullable=true)
     */
    private $naissance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lieu_naissance", type="string", length=100, nullable=true)
     */
    private $lieuNaissance;

    public function getIdActeur(): ?int
    {
        return $this->idActeur;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(?string $biographie): self
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getNaissance(): ?\DateTimeInterface
    {
        return $this->naissance;
    }

    public function setNaissance(?\DateTimeInterface $naissance): self
    {
        $this->naissance = $naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }


}
