<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Films
 *
 * @ORM\Table(name="films")
 * @ORM\Entity
 */
class Films
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_film", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="films_id_film_seq", allocationSize=1, initialValue=1)
     */
    private $idFilm;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="synopsis", type="string", length=255, nullable=true)
     */
    private $synopsis = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_de_sortie", type="date", nullable=true)
     */
    private $dateDeSortie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="duree", type="string", length=20, nullable=true)
     */
    private $duree;

    /**
     * @var string|null
     *
     * @ORM\Column(name="affiche", type="string", length=250, nullable=true)
     */
    private $affiche = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="video_film", type="string", length=255, nullable=true)
     */
    private $videoFilm;

    /**
     * @var int
     *
     * @ORM\Column(name="a_la_une", type="integer", nullable=false)
     */
    private $aLaUne;

    public function getIdFilm(): ?int
    {
        return $this->idFilm;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getDateDeSortie(): ?\DateTimeInterface
    {
        return $this->dateDeSortie;
    }

    public function setDateDeSortie(?\DateTimeInterface $dateDeSortie): self
    {
        $this->dateDeSortie = $dateDeSortie;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getVideoFilm(): ?string
    {
        return $this->videoFilm;
    }

    public function setVideoFilm(?string $videoFilm): self
    {
        $this->videoFilm = $videoFilm;

        return $this;
    }

    public function getALaUne(): ?int
    {
        return $this->aLaUne;
    }

    public function setALaUne(int $aLaUne): self
    {
        $this->aLaUne = $aLaUne;

        return $this;
    }


}
