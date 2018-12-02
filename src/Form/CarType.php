<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
