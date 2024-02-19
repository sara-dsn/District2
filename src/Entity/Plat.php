<?php

namespace App\Entity;

use App\Entity\Detail;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlatRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 50)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?categorie $categorie = null;

    // #[ORM\ManyToOne(inversedBy: 'categorie')]
    // private ?Categorie $categorie = null;

    #[ORM\OneToMany(targetEntity: Detail::class, mappedBy: 'details')]
    private Collection $plat;
 

    public function __construct()
    {
        $this->plat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, detail>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(detail $plat): static
    {
        if (!$this->plat->contains($plat)) {
            $this->plat->add($plat);
            $plat->setPlat($this);
        }

        return $this;
    }

    public function removePlat(detail $plat): static
    {
        if ($this->plat->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getPlat() === $this) {
                $plat->setPlat(null);
            }
        }

        return $this;
    }
}
