<?php

namespace VeterinaireBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use VeterinaireBundle\Entity\Calendrier;
use VeterinaireBundle\Form\CalendrierType;

class CalendrierController extends Controller
{
    public function afficheDispoDashAction()
    {   $user=$this->getUser();
        $calendrier=new Calendrier();
        $calendrier->setCin($user);
        $idUser=$calendrier->getCin();
        $em=$this->getDoctrine()->getManager();
        $calendriervet=$em->getRepository("ZanimauxBundle:Calendrier")->FindByVet($idUser);


        return $this->render('VeterinaireBundle:Calendrier:afficheDispoDash.html.twig',array('calendriervet'=>$calendriervet));


    }

    public function ajouterDispoAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $idUser=$user->getId();
        $calendrierext = $em->getRepository("ZanimauxBundle:Calendrier")->FindByVet($idUser);


        if(!$calendrierext){
            $calendrier = new Calendrier();
        if($request->isMethod("post")){

            $calendrier->setCin($user);


            $time = strtotime($request->get('date_debut'));
            $newformat = date('Y-m-d',$time);
            $calendrier->setDateDebut(new DateTime($newformat));

            $time = strtotime($request->get('date_fin'));
            $newformat = date('Y-m-d',$time);
            $calendrier->setDateFin(new DateTime($newformat));
                $em->persist($calendrier);
                $em->flush();


            return $this->redirectToRoute('afficheDispoDash');
        }} else {
            return $this->render('VeterinaireBundle:Calendrier:afficheDispoDash.html.twig' );
        }

        return $this->render('VeterinaireBundle:Calendrier:ajouterDispo.html.twig');
        }


    public function deleteDispoAction($id){

        $em = $this->getDoctrine()->getManager();
        $calendrier=$em->getRepository("ZanimauxBundle:Calendrier")
            ->find($id);
        $em->remove($calendrier);
        $em->flush();
        return $this->redirectToRoute('ajouterDispo');

    }




}
