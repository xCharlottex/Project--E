<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Mocktails;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MocktailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('preparation')
            ->add('ingredients')
            ->add('titre')
            ->add('submit', SubmitType::class);
            //->add('category', EntityType::class, [
            //    'class' => Category::class,
            //    'choice_label' => function ($category) {
            //        return $category->getTitre();
            //    },
            //    'placeholder' => 'Choisissez votre catégorie',
            //]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mocktails::class,
        ]);
    }
}
