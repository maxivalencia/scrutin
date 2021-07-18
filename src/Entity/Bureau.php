<?php

namespace App\Entity;

use App\Repository\BureauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BureauRepository::class)
 */
class Bureau
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
    private $bureau;

    /**
     * @ORM\ManyToOne(targetEntity=Fokontany::class, inversedBy="bureaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fokontany;

    /**
     * @ORM\OneToMany(targetEntity=Resultat::class, mappedBy="bureau")
     */
    private $resultats;

    public function __construct()
    {
        $this->resultats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBureau(): ?string
    {
        return $this->bureau;
    }

    public function setBureau(string $bureau): self
    {
        $this->bureau = $bureau;

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

    /**
     * @return Collection|Resultat[]
     */
    public function getResultats(): Collection
    {
        return $this->resultats;
    }

    public function addResultat(Resultat $resultat): self
    {
        if (!$this->resultats->contains($resultat)) {
            $this->resultats[] = $resultat;
            $resultat->setBureau($this);
        }

        return $this;
    }

    public function removeResultat(Resultat $resultat): self
    {
        if ($this->resultats->removeElement($resultat)) {
            // set the owning side to null (unless already changed)
            if ($resultat->getBureau() === $this) {
                $resultat->setBureau(null);
            }
        }

        return $this;
    }
}
