<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "avis")]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 100)]
    private $nom;

    #[ORM\Column(type: "string", length: 100)]
    private $prenom;

    #[ORM\Column(type: "text")]
    private $commentaire;

    #[ORM\Column(type: "smallint")]
    private $etoiles;

    #[ORM\Column(type: "datetime")]
    private $dateCreation;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $user = null;



    public function __construct() {
        $this->dateCreation = new \DateTime();
    }

    // Getters & Setters
    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }

    public function getCommentaire(): ?string { return $this->commentaire; }
    public function setCommentaire(string $commentaire): self { $this->commentaire = $commentaire; return $this; }

    public function getEtoiles(): ?int { return $this->etoiles; }
    public function setEtoiles(int $etoiles): self { $this->etoiles = $etoiles; return $this; }

    public function getDateCreation(): ?\DateTimeInterface { return $this->dateCreation; }
    public function setDateCreation(\DateTimeInterface $dateCreation): self { $this->dateCreation = $dateCreation; return $this; }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

}
