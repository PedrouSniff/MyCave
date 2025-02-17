<?php

namespace App\Entity;

use App\Repository\RaisinsVinsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaisinsVinsRepository::class)]
class RaisinsVins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'raisinsVins')]
    private ?Vins $vins = null;

    #[ORM\ManyToOne(inversedBy: 'raisinsVins')]
    private ?Raisins $raisins = null;

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

    public function getRaisins(): ?Raisins
    {
        return $this->raisins;
    }

    public function setRaisins(?Raisins $raisins): static
    {
        $this->raisins = $raisins;

        return $this;
    }
}
