<?php

namespace App\Entity;

use App\Repository\CavesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CavesRepository::class)]
class Caves
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?user $user = null;

    /**
     * @var Collection<int, CavesVins>
     */
    #[ORM\OneToMany(targetEntity: CavesVins::class, mappedBy: 'caves')]
    private Collection $cavesVins;

    public function __construct()
    {
        $this->cavesVins = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CavesVins>
     */
    public function getCavesVins(): Collection
    {
        return $this->cavesVins;
    }

    public function addCavesVin(CavesVins $cavesVin): static
    {
        if (!$this->cavesVins->contains($cavesVin)) {
            $this->cavesVins->add($cavesVin);
            $cavesVin->setCaves($this);
        }

        return $this;
    }

    public function removeCavesVin(CavesVins $cavesVin): static
    {
        if ($this->cavesVins->removeElement($cavesVin)) {
            // set the owning side to null (unless already changed)
            if ($cavesVin->getCaves() === $this) {
                $cavesVin->setCaves(null);
            }
        }

        return $this;
    }
}
