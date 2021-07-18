<?php

namespace App\Entity;

use App\Repository\ElecteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElecteurRepository::class)
 */
class Electeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $electeur;

    /**
     * @ORM\ManyToOne(targetEntity=Fokontany::class, inversedBy="electeurs")
     */
    private $fokontany;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getElecteur(): ?int
    {
        return $this->electeur;
    }

    public function setElecteur(int $electeur): self
    {
        $this->electeur = $electeur;

        return $this;
    }

    public function getFokontany(): ?Fokontany
    {
        return $this->fokontany;
    }

    public function setFokontany(?Fokontany $fokontany): self
    {
        $this->fokontany = $fokontany;

        return $this;
    }
}
