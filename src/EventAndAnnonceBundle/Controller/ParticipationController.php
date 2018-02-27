<?php

namespace EventAndAnnonceBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use EventAndAnnonceBundle\Entity\Evenement;
use Symfony\Component\HttpFoundation\Session\Session;
use EventAndAnnonceBundle\Entity\Participation;
use EventAndAnnonceBundle\EventAndAnnonceBundle;

class ParticipationController extends Controller
{
    public function addParticipationAction($idE)
    {
         $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $participation=new Participation();
        $participation->setCin($user->getId());
        $participation->setIdEvt($idE);

        $em->persist($participation);
        $em->flush();

        $el=$this->getDoctrine()->getManager();
       $participation1=$el->getRepository(Evenement::class)->updateNbParticipants($idE);
        $ok=1;

        return $this->redirectToRoute('read_e',array('ok'=>$ok));
    }


    public function annulerParticipationAction($idE)
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em=$this->getDoctrine()->getManager();
        $participation=$em->getRepository(Participation::class)->deleteParticipants($user->getId(),$idE);


        $el=$this->getDoctrine()->getManager();
        $participation1=$el->getRepository(Evenement::class)->updateNbParticipantsAfterAnnulation($idE);
        $ok=1;

        return $this->redirectToRoute('read_e',array('ok'=>$ok));
    }

}
