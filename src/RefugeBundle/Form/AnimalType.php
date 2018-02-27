<?php

namespace RefugeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type',TextType::class,array('label'=>'Type:'))
            ->add('etat',ChoiceType::class, array('label' => 'Etat',
                'choices' => array('à adopter'=> 'à adopter'),'required' => true))
            ->add('nomanimal',TextType::class,array('label'=>'Nom animal:'))
            ->add('photoanimal',FileType::class,array('label'=>'Une image de votre animal:'))
            ->add('age',TextType::class,array('label'=>'Age animal:'))
            ->add('race',TextType::class,array('label'=>'Race:'))
            ->add('refuge',EntityType::class
                , array('class'=>'RefugeBundle\Entity\Refuge','choice_label'=>'immatriculation','multiple'=>false))
            ->add('Ajouter',SubmitType::class);


    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RefugeBundle\Entity\Animal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'refugeBundle_animal';
    }


}
