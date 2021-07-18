<?php

namespace App\Entity;

use App\Repository\ResultatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultatRepository::class)
 */
class Resultat
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
    private $nombre;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Bureau::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bureau;

    /**
     * @ORM\ManyToOne(targetEntity=Candidat::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat;

    /**
     * @ORM\ManyToOne(targetEntity=Tour::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tour;

    /**
     * @ORM\ManyToOne(targetEntity=Vote::class, inversedBy="resultats")
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity=Session::class, inversedBy="resultats")
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity=Code::class, inversedBy="resultats")
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="resultats")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Mode::class, inversedBy="resultats")
     */
    private $mode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getBureau(): ?Bureau
    {
        return $this->bureau;
    }

    public function setBureau(?Bureau $bureau): self
    {
        $this->bureau = $bureau;

        return $this;
    }

    public function getCandidat(): ?Candidat
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidat $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }

    public function getTour(): ?Tour
    {
        return $this->tour;
    }

    public function setTour(?Tour $tour): self
    {
        $this->tour = $tour;

        return $this;
    }

    public function getVote(): ?Vote
    {
        return $this->vote;
    }

    public function setVote(?Vote $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getCode(): ?Code
    {
        return $this->code;
    }

    public function setCode(?Code $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getMode(): ?Mode
    {
        return $this->mode;
    }

    public function setMode(?Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }
}
