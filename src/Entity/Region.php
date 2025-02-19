<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'regions')]
    private ?Pays $pays = null;

    /**
     * @var Collection<int, Vins>
     */
    #[ORM\OneToMany(targetEntity: Vins::class, mappedBy: 'region')]
    private Collection $vins;

    public function __construct()
    {
        $this->vins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, Vins>
     */
    public function getVins(): Collection
    {
        return $this->vins;
    }

    public function addVin(Vins $vin): static
    {
        if (!$this->vins->contains($vin)) {
            $this->vins->add($vin);
            $vin->setRegion($this);
        }

        return $this;
    }

    public function removeVin(Vins $vin): static
    {
        if ($this->vins->removeElement($vin)) {
            // set the owning side to null (unless already changed)
            if ($vin->getRegion() === $this) {
                $vin->setRegion(null);
            }
        }
        return $this;
    }

    // function toString() pour que mon EasyAdmin puisse afficher les noms des elements au lieu de juste une liste 
    public function __toString(): string
    {
        return $this->nom;
    }
}
