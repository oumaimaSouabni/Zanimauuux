<?php

namespace EventAndAnnonceBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use EventAndAnnonceBundle\Entity\Annonce;
use EventAndAnnonceBundle\Entity\AnnonceFavoris;

class FavorisController extends Controller
{
    public function addFavorisAction($idA)
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $favoris=new AnnonceFavoris();
        $favoris->setCin($user->getId());
        $favoris->setIdA($idA);

        $em->persist($favoris);
        $em->flush();
        $ok=1;

        return $this->redirectToRoute('consulter_a',array('ok'=>$ok));

    }

    public function annulerFavorisAction($idA)
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $favoris=$em->getRepository(AnnonceFavoris::class)->deleteLike($user->getId(),$idA);



        return $this->redirectToRoute('consulter_a');
    }

    public function readFavAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $annoncesFavoris = $this->getDoctrine()
            ->getRepository(AnnonceFavoris::class)
            ->readFavoris($user->getId());


        return $this->render('EventAndAnnonceBundle:Annonce:consulterFavoris.html.twig',array(
            'user' => $user,
            'annoncesFavoris'=>$annoncesFavoris,
            ));
    }

}
