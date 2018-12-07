<?php

namespace App\Form;

use App\Entity\Tool;
use App\Entity\ToolReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class ReserveToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tools = $options['tools'];
        $builder
            ->add('startDate', DateType::class, array('label' => 'Rezervacijos pradžia'))
            ->add('endDate', DateType::class, array('label' => 'Rezervacijos pabaiga'))
            ->add('tool', ChoiceType::class, array(
                'choices' => $tools,
                'choice_label' => function($tool, $key, $value) {
                    return $tool->getTitle();
                },
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setRequired('tools');
//        $resolver->setAllowedTypes('tools', array(array(), 'int'));

        $resolver->setDefaults(array(
            'tools' => array(),
            )
        );
    }
}
