<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prijs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $frontpage;

    /**
     * @ORM\ManyToOne(targetEntity=Btw::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $btw_id;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="product_id")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=FactuurRegel::class, mappedBy="product_id")
     */
    private $factuurRegels;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->factuurRegels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(?float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getFrontpage(): ?bool
    {
        return $this->frontpage;
    }

    public function setFrontpage(bool $frontpage): self
    {
        $this->frontpage = $frontpage;

        return $this;
    }

    public function getBtwId(): ?Btw
    {
        return $this->btw_id;
    }

    public function setBtwId(?Btw $btw_id): self
    {
        $this->btw_id = $btw_id;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProductId($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getProductId() === $this) {
                $image->setProductId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FactuurRegel[]
     */
    public function getFactuurRegels(): Collection
    {
        return $this->factuurRegels;
    }

    public function addFactuurRegel(FactuurRegel $factuurRegel): self
    {
        if (!$this->factuurRegels->contains($factuurRegel)) {
            $this->factuurRegels[] = $factuurRegel;
            $factuurRegel->setProductId($this);
        }

        return $this;
    }

    public function removeFactuurRegel(FactuurRegel $factuurRegel): self
    {
        if ($this->factuurRegels->contains($factuurRegel)) {
            $this->factuurRegels->removeElement($factuurRegel);
            // set the owning side to null (unless already changed)
            if ($factuurRegel->getProductId() === $this) {
                $factuurRegel->setProductId(null);
            }
        }

        return $this;
    }
}
