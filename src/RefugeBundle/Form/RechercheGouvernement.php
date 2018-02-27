<?php
/**
 * Created by PhpStorm.
 * User: Azza
 * Date: 2/23/2018
 * Time: 11:10 PM
 */

namespace RefugeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheGouvernement extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('gouvernementrefuge', ChoiceType::class, array('label' => 'Filtrer par Region: ',
            'choices' => array('Tout'=> 'Tout',
                'Tunis'=> 'Tunis',
                ' Ben arous' => 'Ben arous',
                'Ariana' => 'Ariana',
                'Nabeul' => 'Nabeul',
                'Sfax' => 'Sfax',
                'Sousse' => 'Sousse'   )))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'esprit_parc_bundlerecherche_serie_voiture';
    }
}
