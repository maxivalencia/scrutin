<?php

namespace App\Entity;

use App\Repository\PopulationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PopulationRepository::class)
 */
class Population
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
    private $population;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="populations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commune;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getPopulation();
    }
}
