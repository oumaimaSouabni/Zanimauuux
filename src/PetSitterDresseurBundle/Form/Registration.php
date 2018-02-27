<?php

namespace PetSitterDresseurBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Registration extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('cinDresseur',EntityType::class,array(
                'class' => 'ZanimauxBundle\Entity\User',
                'label'=>'CIN'))
            ->add('nomParc',TextType::class,array('label'=>'Nom du parc'))
            ->add('CategorieDressage',ChoiceType::class,array('label'=>'Adresse du parc',
                'choices' => array('Chien'=> 'Chien',
                    ' Chevaux' => 'Chevaux',
                    'Autre' => 'Autre',
                    )))
            ->add('adresseParc',TextType::class,array('label'=>'Adresse du parc'))
            ->add('villeParc',TextType::class,array('label'=>'Ville du parc'))
            ->add('codePostaleParc',TextType::class,array('label'=>'Code Postale'))
            ->add('photoParc',FileType::class,array('label'=>'Photo du parc'))
            ->add('Ajouter',SubmitType::class);

; }
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'Petsitterdresseur_bundle_registration';
    }
}
