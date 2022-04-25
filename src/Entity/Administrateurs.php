<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrateurs
 *
 * @ORM\Table(name="administrateurs")
 * @ORM\Entity
 */
class Administrateurs
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="administrateurs_email_seq", allocationSize=1, initialValue=1)
     */
    private $email = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=105, nullable=true)
     */
    private $nom = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=150, nullable=true)
     */
    private $prenom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=62, nullable=false)
     */
    private $password;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


}
