<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Cocktails;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ingredients')
            ->add('preparation')
            ->add('titre')
            ->add('submit', SubmitType::class);
            // j'ajoute le champs category pour gérer la sélection d'une
            // catégorie pour l'article
            // je lui mets le type "EntityType" car c'est une relation vers
            // une entité
            // et je parametre mon input pour qu'il affiche toutes les catégories
            // de la bdd avec leur titre dans les options du select
            //->add('category', EntityType::class, [
            //    'class' => Category::class,
            //    'choice_label' => function ($category) {
            //    return $category->getTitre();
            //    },
            //    'placeholder' => 'Choisissez votre catégorie',
            //]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cocktails::class,
        ]);
    }
}
