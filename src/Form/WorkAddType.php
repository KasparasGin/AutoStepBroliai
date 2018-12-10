<?php

namespace App\Form;

use App\Entity\Work;
use App\Entity\Visit;
use App\Entity\User;
use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class WorkAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $visits = $options['visits'];
        $builder
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Apžiūra' => 'Apžiūra',
                    'Remontas' => 'Remontas',
                    'Diagnostika' => 'Diagnostika',              
                ),
                'label' => 'Darbo tipas',
                'multiple' => False,
                'expanded' => False,
                ))
            ->add('description', TextType::class, array('label' => 'Aprašymas'))
            ->add('timeNeeded',   ChoiceType::class, array(
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',              
                ),
                'label' => 'Skirtas Laikas',
                'multiple' => False,
                'expanded' => False,
                ))
            ->add('visit', ChoiceType::class, array(
                'choices' => $visits,
                'choice_label' => function($visit, $key, $value) {
                    $car = $visit->getCar();
                    return $car->getRegistrationPlate();
                },
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setRequired('visits');
//        $resolver->setAllowedTypes('visits', array(array(), 'int'));

        $resolver->setDefaults(array(
            'visits' => array(),
            )
        );
    }

}
