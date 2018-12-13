<?php

namespace App\Form;

use App\Entity\Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;

class WayBillAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        //$builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
        $builder
            ->add('supplier', EntityType::class, array(
                'label' => 'Tiekėjas',
                'class' => Supplier::class,
                'expanded' => false,
                'multiple' => false
            ))
            //->add('supplier', TextType::class, array('label' => 'Tiekėjas'))
            ->add('quantity', TextType::class, array('label' => 'Prekių kiekis'))
            ->add('totalPrice', TextType::class, array('label' => 'Bendra suma'))
        ;
    }
    /*protected function addElements(FormInterface $form, Supplier $supplier = null) {
        $form->add('supplier', EntityType::class, array(
            'required' => true,
            'data' => $supplier,
            'placeholder' => 'Pasirinkite tiekėją...',
            'class' => 'AppBundle:Supplier'
        ));
    }
    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        $supplier = $this->em->getRepository('AppBundle:Supplier')->find($data['name']);

        $this->addElements($form, $supplier);
    }
    function onPreSetData(FormEvent $event) {
        $supplier = $event->getData();
        $form = $event->getForm();

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplier::class,
        ]);
    }*/
}
