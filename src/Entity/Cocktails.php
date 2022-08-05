<?php

namespace App\Entity;

use App\Repository\CocktailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CocktailsRepository::class)
 */
class Cocktails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    // recupere avec cocktails toutes les Categories qui lui sont liés (qui possede l'id de Category)







    /**
     * @ORM\Column(type="text")
     */
    private $preparation;

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="cocktails")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredients::class, inversedBy="cocktails")
     */
    private $ingredients;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
    public function getIngredients(): ?Ingredients
    {
        return $this->ingredients;
    }

    public function setIngredients(?Ingredients $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

}
