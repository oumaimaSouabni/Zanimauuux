<?php

namespace VeterinaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;




class CabinetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('emailcabinet',TextType::class,array('label'=>'Email de votre cabinet:'))
            ->add('telephonecabinet',TextType::class,array('label'=>'Telephone :'))
            ->add('faxcabinet',TextType::class,array('label'=>'Fax :'))
            ->add('photovet',FileType::class,array('label'=>'Votre photo :',
                array(
                    'data_class' => 'Symfony\Component\HttpFoundation\File\File')))
            ->add('adressecabinet',TextType::class,array('label'=>'Adresse :'))
            ->add('villecabinet',TextType::class,array('label'=>'Ville :'))
            ->add('codepostalecabinet',TextType::class,array('label'=>'Code Postale :'));


    }

   /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VeterinaireBundle\Entity\Cabinet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'veterinairebundle_cabinet';
    }


}
