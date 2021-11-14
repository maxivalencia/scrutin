<?php

namespace App\Entity;

use App\Repository\FokontanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FokontanyRepository::class)
 */
class Fokontany
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
    private $fokontany;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="fokontanies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commune;

    /**
     * @ORM\OneToMany(targetEntity=Bureau::class, mappedBy="fokontany")
     */
    private $bureaus;

    /**
     * @ORM\OneToMany(targetEntity=Electeur::class, mappedBy="fokontany")
     */
    private $electeurs;

    public function __construct()
    {
        $this->bureaus = new ArrayCollection();
        $this->electeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFokontany(): ?string
    {
        return $this->fokontany;
    }

    public function setFokontany(string $fokontany): self
    {
        $this->fokontany = $fokontany;

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
     * @return Collection|Bureau[]
     */
    public function getBureaus(): Collection
    {
        return $this->bureaus;
    }

    public function addBureau(Bureau $bureau): self
    {
        if (!$this->bureaus->contains($bureau)) {
            $this->bureaus[] = $bureau;
            $bureau->setFokontany($this);
        }

        return $this;
    }

    public function removeBureau(Bureau $bureau): self
    {
        if ($this->bureaus->removeElement($bureau)) {
            // set the owning side to null (unless already changed)
            if ($bureau->getFokontany() === $this) {
                $bureau->setFokontany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Electeur[]
     */
    public function getElecteurs(): Collection
    {
        return $this->electeurs;
    }

    public function addElecteur(Electeur $electeur): self
    {
        if (!$this->electeurs->contains($electeur)) {
            $this->electeurs[] = $electeur;
            $electeur->setFokontany($this);
        }

        return $this;
    }

    public function removeElecteur(Electeur $electeur): self
    {
        if ($this->electeurs->removeElement($electeur)) {
            // set the owning side to null (unless already changed)
            if ($electeur->getFokontany() === $this) {
                $electeur->setFokontany(null);
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
        return $this->getFokontany();
    }
}
