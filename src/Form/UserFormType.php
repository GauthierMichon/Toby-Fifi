<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ])
            ->add('date_naissance', DateType::class, array(
                'years' => range(date('Y'), date('Y') - 100)
            ))
            ->add('solde', MoneyType::class, [
                'attr' => [
                    "class" => "form-control"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
