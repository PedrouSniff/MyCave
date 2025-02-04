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
    private ?vins $vins = null;

    #[ORM\ManyToOne(inversedBy: 'cavesVins')]
    private ?caves $caves = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVins(): ?vins
    {
        return $this->vins;
    }

    public function setVins(?vins $vins): static
    {
        $this->vins = $vins;

        return $this;
    }

    public function getCaves(): ?caves
    {
        return $this->caves;
    }

    public function setCaves(?caves $caves): static
    {
        $this->caves = $caves;

        return $this;
    }
}
