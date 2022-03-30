<?php

namespace App\Entity;

use App\Repository\FonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FonctionRepository::class)
 */
class Fonction
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
    private $fonctionName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonctionDescription;

    /**
     * @ORM\OneToMany(targetEntity=GrUser::class, mappedBy="fonction")
     */
    private $grUsers;

    public function __construct()
    {
        $this->grUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFonctionName(): ?string
    {
        return $this->fonctionName;
    }

    public function setFonctionName(string $fonctionName): self
    {
        $this->fonctionName = $fonctionName;

        return $this;
    }

    public function getFonctionDescription(): ?string
    {
        return $this->fonctionDescription;
    }

    public function setFonctionDescription(string $fonctionDescription): self
    {
        $this->fonctionDescription = $fonctionDescription;

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
            $grUser->setFonction($this);
        }

        return $this;
    }

    public function removeGrUser(GrUser $grUser): self
    {
        if ($this->grUsers->removeElement($grUser)) {
            // set the owning side to null (unless already changed)
            if ($grUser->getFonction() === $this) {
                $grUser->setFonction(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->fonctionName;
    }
}
