<?php

namespace App\Form;

use App\Entity\Visit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class, array('label' => 'Data'))
            ->add('time', TimeType::class, array('label' => 'Laikas'))
            ->add('description',TextType::class, array('label' => 'Aprašymas'))
            ->add('state', ChoiceType::class, array( 'label' => 'Būsena',
                'choices'  => array(
                    'Vykdomas' => "1",
                    'Baigtas' => "2",
                    'Atšauktas' => "0",
                ),
            ))
            ->add('submit', SubmitType::class, array('label' => 'Atnaujinti'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visit::class,
        ]);
    }
}
