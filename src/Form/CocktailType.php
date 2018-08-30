<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Cocktails;
use App\Entity\Ingredients;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('volume')
            ->add('origine')
            ->add('imageUrl')
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'nom'
            ])
            //->add('ingredients', IngredientType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cocktails::class,
        ]);
    }
}
