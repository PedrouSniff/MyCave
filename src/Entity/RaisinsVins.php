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
    private ?vins $vins = null;

    #[ORM\ManyToOne(inversedBy: 'raisinsVins')]
    private ?raisins $raisins = null;

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

    public function getRaisins(): ?raisins
    {
        return $this->raisins;
    }

    public function setRaisins(?raisins $raisins): static
    {
        $this->raisins = $raisins;

        return $this;
    }
}
