<?php

namespace App\Entity;

use App\Repository\CavesVinsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CavesVinsRepository::class)]
class CavesVins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cavesVins')]
    private ?Vins $vins = null;

    #[ORM\ManyToOne(inversedBy: 'cavesVins')]
    private ?Caves $caves = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVins(): ?Vins
    {
        return $this->vins;
    }

    public function setVins(?Vins $vins): static
    {
        $this->vins = $vins;

        return $this;
    }

    public function getCaves(): ?Caves
    {
        return $this->caves;
    }

    public function setCaves(?Caves $caves): static
    {
        $this->caves = $caves;

        return $this;
    }
}
