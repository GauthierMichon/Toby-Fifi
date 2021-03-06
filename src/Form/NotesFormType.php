<?php

namespace App\Form;

use App\Entity\Notes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("note", RangeType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add("submit", SubmitType::class, [
                'attr' => [
                    "class" => "btn btn-primary centrage"

                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notes::class,
        ]);
    }
}




/*->add('note', RangeType::class, array(
    'attr' => array('min' => 1, 'max' => 5)
))*/