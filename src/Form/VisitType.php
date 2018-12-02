<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class, array('label' => 'Automobilio marke'))
            ->add('model', TextType::class, array('label' => 'Automobilio modelis'))
            ->add('year', TextType::class, array('label' => 'Pagaminimo metai'))
            ->add('gearbox', TextType::class, array('label' => 'Pavaru deze'))
            ->add('fuelType', TextType::class, array('label' => 'Kuro tipas'))
            ->add('registrationPlate', TextType::class, array('label' => 'Registracijos numeris'))
            ->add('date', DateType::class, array('label' => 'Apsilankymo data'))
            ->add('time', TimeType::class, array('label' => 'Apsilankymo laikas'))
            ->add('description', TextType::class, array('label' => 'Aprasymas'))
        ;
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => Visit::class,
//        ]);
//    }
}
