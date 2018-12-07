<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Twig\Profiler\Node\LeaveProfileNode;

class SupplierAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company_code', TextType::class, array(
                'label' => 'Įmonės kodas',
                'constraints' => new Length(array('max' => 9, 'min' => 9)),
            ))
            ->add('name', TextType::class, array('label' => 'Pavadinimas'))
            ->add('address', TextType::class, array('label' => 'Adresas'))
            ->add('accNumber', TextType::class, array(
                'label' => 'Sąskaitos numeris',
                'constraints' => new Length(array('max' => 20, 'min' => 20))
            ))
        ;
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => Visit::class,
//        ]);
//    }
}
