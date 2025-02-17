<?php

namespace App\Entity;

use App\Repository\CavesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
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

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne()]
    private ?User $user = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, CavesVins>
     */
    #[ORM\OneToMany(targetEntity: CavesVins::class, mappedBy: 'caves')]
    private Collection $cavesVins;

    public function __construct()
    {
        $this->cavesVins = new ArrayCollection();
        $this->date = new \DateTime();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
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

    public function setImageFile(?File $imageFile = null): void
    {
    $this->imageFile = $imageFile;

        if ($imageFile) {
            // Si un fichier est chargé, met à jour la date
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
