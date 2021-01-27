<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('stock', IntegerType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('prix', MoneyType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('duree_livraison', IntegerType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add("Modifier", SubmitType::class, [
                'attr' => [
                    "class" => "btn btn-primary centrage"

                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
