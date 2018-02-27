<?php

namespace VeterinaireBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendrierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tempsc',  TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('datedebut', DateType::class, array('attr' => array('class' => 'form-control')))
                ->add('datefin', DateType::class, array('attr' => array('class' => 'form-control')));;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VeterinaireBundle\Entity\Calendrier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'veterinairebundle_calendrier';
    }


}
