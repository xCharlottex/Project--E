<?php

namespace App\Entity;

use App\Repository\PageCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageCategoryRepository::class)
 */
class PageCategory
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

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
     * @ORM\OneToMany(targetEntity="App\Entity\PageCocktail", mappedBy="category")
     */
    private $cocktails;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageMocktail", mappedBy="category")
     */
    private $mocktails;


}
