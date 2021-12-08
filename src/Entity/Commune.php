<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommuneRepository::class)
 */
class Commune
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @ORM\ManyToOne(targetEntity=District::class, inversedBy="communes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $district;

    /**
     * @ORM\OneToMany(targetEntity=Fokontany::class, mappedBy="commune")
     */
    private $fokontanies;

    /**
     * @ORM\OneToMany(targetEntity=Population::class, mappedBy="commune")
     */
    private $populations;

    public function __construct()
    {
        $this->fokontanies = new ArrayCollection();
        $this->populations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommune(): ?string
    {
        return strtoupper($this->commune);
    }

    public function setCommune(string $commune): self
    {
        $this->commune = strtoupper($commune);

        return $this;
    }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district): self
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return Collection|Fokontany[]
     */
    public function getFokontanies(): Collection
    {
        return $this->fokontanies;
    }

    public function addFokontany(Fokontany $fokontany): self
    {
        if (!$this->fokontanies->contains($fokontany)) {
            $this->fokontanies[] = $fokontany;
            $fokontany->setCommune($this);
        }

        return $this;
    }

    public function removeFokontany(Fokontany $fokontany): self
    {
        if ($this->fokontanies->removeElement($fokontany)) {
            // set the owning side to null (unless already changed)
            if ($fokontany->getCommune() === $this) {
                $fokontany->setCommune(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Population[]
     */
    public function getPopulations(): Collection
    {
        return $this->populations;
    }

    public function addPopulation(Population $population): self
    {
        if (!$this->populations->contains($population)) {
            $this->populations[] = $population;
            $population->setCommune($this);
        }

        return $this;
    }

    public function removePopulation(Population $population): self
    {
        if ($this->populations->removeElement($population)) {
            // set the owning side to null (unless already changed)
            if ($population->getCommune() === $this) {
                $population->setCommune(null);
            }
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCommune();
    }
}
