<?php

namespace App\Entity;

use App\Repository\RaisinsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaisinsRepository::class)]
class Raisins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, RaisinsVins>
     */
    #[ORM\OneToMany(targetEntity: RaisinsVins::class, mappedBy: 'raisins')]
    private Collection $raisinsVins;

    public function __construct()
    {
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
            $raisinsVin->setRaisins($this);
        }

        return $this;
    }

    public function removeRaisinsVin(RaisinsVins $raisinsVin): static
    {
        if ($this->raisinsVins->removeElement($raisinsVin)) {
            // set the owning side to null (unless already changed)
            if ($raisinsVin->getRaisins() === $this) {
                $raisinsVin->setRaisins(null);
            }
        }

        return $this;
    }
}
