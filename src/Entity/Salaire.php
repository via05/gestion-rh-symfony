<?php

namespace App\Entity;

use App\Repository\SalaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalaireRepository::class)
 */
class Salaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity=GrUser::class, mappedBy="salaire")
     */
    private $grUsers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valeur;

    public function __construct()
    {
        $this->grUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection<int, GrUser>
     */
    public function getGrUsers(): Collection
    {
        return $this->grUsers;
    }

    public function addGrUser(GrUser $grUser): self
    {
        if (!$this->grUsers->contains($grUser)) {
            $this->grUsers[] = $grUser;
            $grUser->setSalaire($this);
        }

        return $this;
    }

    public function removeGrUser(GrUser $grUser): self
    {
        if ($this->grUsers->removeElement($grUser)) {
            // set the owning side to null (unless already changed)
            if ($grUser->getSalaire() === $this) {
                $grUser->setSalaire(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->valeur;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }
}
