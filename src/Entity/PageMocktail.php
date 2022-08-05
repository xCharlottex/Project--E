<?php

namespace App\Entity;

use App\Repository\PageMocktailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageMocktailRepository::class)
 */
class PageMocktail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

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
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $ingredients;


}
