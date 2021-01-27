<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\LesDiffCategories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_categorie', EntityType::class, [
                'class' => LesDiffCategories::class,
                'choice_label' => function ($categories) {
                    return $categories->getNom();
                }
            ])
            ->add("Ajouter", SubmitType::class, [
                'attr' => [
                    "class" => "btn btn-primary"

                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
