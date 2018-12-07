<?php

namespace App\Form;

use App\Entity\Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SupplierEditType extends AbstractType
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
            ->add('submit', SubmitType::class, array('label' => 'Atnaujinti'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplier::class,
        ]);
    }
}
