<?php

namespace EventAndAnnonceBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use EventAndAnnonceBundle\Entity\Annonce;
use EventAndAnnonceBundle\Entity\AnnonceFavoris;
use EventAndAnnonceBundle\Form\AnnonceType;

class AnnonceController extends Controller
{
    //Ajouter une annonce

    public function ajouterAction(Request $request)
    { $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $annonce = new Annonce();
        $user = $this->getUser();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $annonce->setCin($user->getId());
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $annonce = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();
           return $this->redirectToRoute('consulter_a');
        }
        return $this->render('EventAndAnnonceBundle:Annonce:ajouter.html.twig', array(
            'user'=>$user,
            'form' => $form->createView()));
    }

    //Mise à jour annonce

    public function ModifierAction(Request $request, $idAnnonce)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $annonce=$em->getRepository(Annonce::class)->find($idAnnonce);
        $form=$this->createFormBuilder($annonce)
            ->add('titre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('type', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('piecejointe', FileType::class, array('attr' => array('class' => 'form-control'),'data_class' => null))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid() ){
            $annonce = $form->getData();
            $em->persist($annonce);
            $em->flush();
            return $this->redirectToRoute('consulter_a');

        }

        return $this->render('EventAndAnnonceBundle:Annonce:modifier.html.twig', array(
            'user'=>$user,
            'annonce'=>$annonce,
            'form'=>$form->createView()

        ));
    }

    //Supprimer annonce

    public function SupprimerAction($idAnnonce){

        $em = $this->getDoctrine()->getManager();
        $annonce=$em->getRepository(Annonce::class)
            ->find($idAnnonce);
        $em->remove($annonce);
        $em->flush();
        return $this->redirectToRoute('consulter_a',['annonce'=>$annonce]);
    }

    //Consulter la liste des annonces

    public function ConsulterAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $annonces = $this->getDoctrine()
            ->getRepository(Annonce::class)
            ->findAll();
        $paginator =$this->get('knp_paginator');
        $result=$paginator->paginate(
            $annonces,
            $request->query->getInt('page',2),
            $request->query->getInt('limit',2)
        );

        //chercher la liste des annonce favoris dans la table annonce
        $favoris = $this->getDoctrine()
            ->getRepository(AnnonceFavoris::class)
            ->findBy(array('cin'=>$user->getId()));


        return $this->render('EventAndAnnonceBundle:Annonce:consulter.html.twig',array(
            'user' => $user,
            'annonces'=>$result,
            'favoris'=>$favoris));
    }

    public function addAnnonceAdminAction(Request $request){
        $annonces =new Annonce();
        $user=$this->getUser();

        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $annonces->setCin($user) ;

            $annonces->setTitre($request->get('type'));
            $annonces->setType($request->get('date'));
            $annonces->setDescription($request->get('description'));
            $annonces->setPieceJointe($request->get('photoanimal'));
            $em->persist($annonces);
            $em->flush();
            return $this->redirectToRoute('afficherAnnonceAdmin',['annonces'=>$annonces]);

        }
        return $this->render('EventAndAnnonceBundle:Annonce:addAnnoncesDashboard.html.twig');
    }

    public function afficherAnnoncetAdminAction()
    {   $user=$this->getUser();
        $annonces =new Annonce();
        $annonces = $this->getDoctrine()
            ->getRepository(Annonce::class)
            ->findAll();

        return $this->render('EventAndAnnonceBundle:Annonce:afficherAnnonceDash.html.twig',array('annonces'=>$annonces));


    }

    public function supprimerAnnonceAdminAction($idAnnonce)
    {
        $em = $this->getDoctrine()->getManager();
        $annonces=$em->getRepository(Annonce::class)
            ->find($idAnnonce);
        $em->remove($annonces);
        $em->flush();
        return $this->redirectToRoute('afficherAnnonceAdmin');

    }

    public function modifierAnnonceAdminAction(Request $request,$idAnnonce)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonce::class)->find($idAnnonce);
        $user=$this->getUser();

        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $annonce->setTitre($request->get('titre'));
            $annonce->setType($request->get('type'));
            $annonce->setDescription($request->get('description'));
            $annonce->setPieceJointe($request->get('piecejointe'));
            $em->persist($annonce);
            $em->flush();
            return $this->redirectToRoute('afficherAnnonceAdmin');

        }
        return $this->render('EventAndAnnonceBundle:Annonce:modifierAnnonceAdmin.html.twig',['annonce'=>$annonce]);

    }


}
