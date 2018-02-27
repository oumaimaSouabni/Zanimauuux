<?php

namespace EventAndAnnonceBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('type', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('lieu',  TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('datedebut', DateType::class, array('widget'=>'single_text','attr' => array('class' => 'form-control')))
            ->add('datefin', DateType::class, array('widget'=>'single_text','attr' => array('class' => 'form-control')))
            ->add('imageEvt', FileType::class, array('attr' => array('class' => 'form-control'),'data_class' => null))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('nbplace', NumberType::class, array('attr' => array('class' => 'form-control')))
           ->add('creer', SubmitType::class, array('attr' => array('class' => 'form-control')))
            ->add('Annuler', ResetType::class, array('attr' => array('class' => 'form-control')));;

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EventAndAnnonceBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'EventAndAnnonceBundle_evenement';
    }


}
