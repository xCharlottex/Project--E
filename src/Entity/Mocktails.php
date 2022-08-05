<?php

namespace App\Entity;

use App\Repository\MocktailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MocktailsRepository::class)
 */
class Mocktails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $preparation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="mocktails")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredients::class, inversedBy="mocktails")
     */
    private $ingredients;



    /**
     * @return mixed
     */
    public function getPreparation()
    {
        return $this->preparation;
    }

    /**
     * @param mixed $preparation
     */
    public function setPreparation($preparation): void
    {
        $this->preparation = $preparation;
    }


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

    public function getId(): ?int
    {
        return $this->id;
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

    public function setCIngredients(?Ingredients $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

   
}
