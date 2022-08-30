<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // clé étrangere créé, créé la relation

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @return mixed
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * @param mixed $texte
     */
    public function setTexte($texte): void
    {
        $this->texte = $texte;
    }


    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\OneToMany(targetEntity=Cocktails::class, mappedBy="category")
     */
    private $cocktails;

    /**
     * @ORM\OneToMany(targetEntity=Mocktails::class, mappedBy="category")
     */
    private $mocktails;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCocktailCategory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $backgroundImage;

    public function __construct()
    {
        $this->cocktails = new ArrayCollection();
        $this->mocktails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }



    /**
     * @return Collection<int, Cocktails>
     */
    public function getCocktails(): Collection
    {
        return $this->cocktails;
    }

    public function addCocktail(Cocktails $cocktail): self
    {
        if (!$this->cocktails->contains($cocktail)) {
            $this->cocktails[] = $cocktail;
            $cocktail->setCategory($this);
        }

        return $this;
    }

    public function removeCocktail(Cocktails $cocktail): self
    {
        if ($this->cocktails->removeElement($cocktail)) {
            // set the owning side to null (unless already changed)
            if ($cocktail->getCategory() === $this) {
                $cocktail->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mocktails>
     */
    public function getMocktails(): Collection
    {
        return $this->mocktails;
    }

    public function addMocktail(Mocktails $mocktail): self
    {
        if (!$this->mocktails->contains($mocktail)) {
            $this->mocktails[] = $mocktail;
            $mocktail->setCategory($this);
        }

        return $this;
    }

    public function removeMocktail(Mocktails $mocktail): self
    {
        if ($this->mocktails->removeElement($mocktail)) {
            // set the owning side to null (unless already changed)
            if ($mocktail->getCategory() === $this) {
                $mocktail->setCategory(null);
            }
        }

        return $this;
    }

    public function isIsCocktailCategory(): ?bool
    {
        return $this->isCocktailCategory;
    }

    public function setIsCocktailCategory(bool $isCocktailCategory): self
    {
        $this->isCocktailCategory = $isCocktailCategory;

        return $this;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(string $backgroundImage): self
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }
}
