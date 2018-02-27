<?php

namespace PetSitterDresseurBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromenadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                 ->add('cinPetsitter',EntityType::class,array(
        'class'=> 'ZanimauxBundle\Entity\User',
        'label'=>'CIN')
)
                 ->add('nomPromenade')
                 ->add('lieuPromenade')
                ->add('typePromenade',ChoiceType::class,array('label'=>'Adresse du parc',
        'choices' => array('Promenade'=> 'Promenade',
            ' Garde' => 'Garde',
            'Autre' => 'Autre',
        )))
                 ->add('descriptionPromenade')
                    ->add('datedebutPromenade')
                 ->add('datefinPromenade')
                 ->add('Ajouter',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'petsitterdresseur_bundle_promenade_type';
    }
}
