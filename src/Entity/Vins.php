<?php

namespace App\Entity;

use App\Repository\VinsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VinsRepository::class)]
class Vins
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

    /**
     * @var Collection<int, CavesVins>
     */
    #[ORM\OneToMany(targetEntity: CavesVins::class, mappedBy: 'vins')]
    private Collection $cavesVins;

    /**
     * @var Collection<int, RaisinsVins>
     */
    #[ORM\OneToMany(targetEntity: RaisinsVins::class, mappedBy: 'vins')]
    private Collection $raisinsVins;

    #[ORM\ManyToOne(inversedBy: 'vins')]
    private ?region $region = null;

    public function __construct()
    {
        $this->cavesVins = new ArrayCollection();
        $this->raisinsVins = new ArrayCollection();
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
            $cavesVin->setVins($this);
        }

        return $this;
    }

    public function removeCavesVin(CavesVins $cavesVin): static
    {
        if ($this->cavesVins->removeElement($cavesVin)) {
            // set the owning side to null (unless already changed)
            if ($cavesVin->getVins() === $this) {
                $cavesVin->setVins(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RaisinsVins>
     */
    public function getRaisinsVins(): Collection
    {
        return $this->raisinsVins;
    }

    public function addRaisinsVin(RaisinsVins $raisinsVin): static
    {
        if (!$this->raisinsVins->contains($raisinsVin)) {
            $this->raisinsVins->add($raisinsVin);
            $raisinsVin->setVins($this);
        }

        return $this;
    }

    public function removeRaisinsVin(RaisinsVins $raisinsVin): static
    {
        if ($this->raisinsVins->removeElement($raisinsVin)) {
            // set the owning side to null (unless already changed)
            if ($raisinsVin->getVins() === $this) {
                $raisinsVin->setVins(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?region
    {
        return $this->region;
    }

    public function setRegion(?region $region): static
    {
        $this->region = $region;

        return $this;
    }
}
