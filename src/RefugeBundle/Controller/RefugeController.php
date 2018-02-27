<?php

namespace RefugeBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use RefugeBundle\Entity\QuestionnaireChat;
use RefugeBundle\Entity\QuestionnaireChien;
use RefugeBundle\Entity\Race;
use RefugeBundle\Entity\Refuge;
use ZanimauxBundle\Entity\User;
use RefugeBundle\Form\RechercheGouvernement;

class RefugeController extends Controller
{
    public function indexAction($immatriculation)
    {

        $refuges = $this->getDoctrine()
            ->getRepository(Refuge::class)->find($immatriculation);


        return $this->render('RefugeBundle:Refuge:googleMap.html.twig',['refuges'=>$refuges]);
    }
    public function recherchePlusProcheAction(){
        $user=$this->getUser();
        $refuge=new Refuge();
        $refuge->setCin($user);
        $idUser=$refuge->getCin();
        $em1=$this->getDoctrine()->getManager();
        $users=$em1->getRepository("ZanimauxBundle:User")->find($idUser);
        $em=$this->getDoctrine()->getManager();
        $refuges=$em->getRepository("RefugeBundle:Refuge")->findAll();
        return $this->render('RefugeBundle:Refuge:adress_map.html.twig',['refuges'=>$refuges,'users'=>$users]);
    }
    public function questionnaireChatInternauteAction(Request $request){
        $race=[];
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $race = $em
                ->getRepository(QuestionnaireChat::class)
                ->findRaceChat($request->get('tolererChien'),
                    $request->get('dynamique'),
                    $request->get('affectueux'),
                    $request->get('chutePoils'),
                    $request->get('intelligent'),
                    $request->get('acceptationEtranger'));


        }
        return $this->render('RefugeBundle:Questionnaire:questionnaire_chat_internaute.html.twig',
            ['race' => $race]);
    }
    public function questionnaireChatAction(Request $request){
        $race=[];
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $race = $em
                ->getRepository(QuestionnaireChat::class)
                ->findRaceChat($request->get('tolererChien'),
                    $request->get('dynamique'),
                    $request->get('affectueux'),
                    $request->get('chutePoils'),
                    $request->get('intelligent'),
                    $request->get('acceptationEtranger'));


        }
        return $this->render('RefugeBundle:Questionnaire:questionnaire_chat.html.twig',
            ['race' => $race]);
    }
    public function questionnaireChienAction(Request $request){
        $race=[];
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $race = $em
                ->getRepository(QuestionnaireChien::class)
                ->findRaceChien($request->get('tolererChien'),
                    $request->get('tolererChat'),
                    $request->get('affectueux'),
                    $request->get('calme'),
                    $request->get('intelligent'),
                    $request->get('chutePoils'));
        }
        return $this->render('RefugeBundle:Questionnaire:questionnaire_chien.html.twig',
            ['race' => $race]);
    }
    public function questionnaireChienInternauteAction(Request $request){
        $race=[];
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $race = $em
                ->getRepository(QuestionnaireChien::class)
                ->findRaceChien($request->get('tolererChien'),
                    $request->get('tolererChat'),
                    $request->get('affectueux'),
                    $request->get('calme'),
                    $request->get('intelligent'),
                    $request->get('chutePoils'));
        }
        return $this->render('RefugeBundle:Questionnaire:questionnaire_chien_internaute.html.twig',
            ['race' => $race]);
    }




    public function deleteRefugeAction($immatriculation){
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $refuge2=$em->getRepository(Refuge::class)->find($immatriculation);
        $em->remove($refuge2);
        $em->flush();
        return $this->redirectToRoute('afficher_refuge_dashboard');
    }

    public function AfficherRefugeDashboardAction()
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $refuge=new Refuge();
        $refuge->setCin($user);
        $idUser=$refuge->getCin();
            $em=$this->getDoctrine()->getManager();
            $refuges=$em->getRepository("RefugeBundle:Refuge")->rechercheParCinDQL($idUser);
            return $this->render('RefugeBundle:Refuge:afficher_refuge_dashboard.html.twig',
                array( 'refuges'=>$refuges));

    }


    public function AfficherRefugeInternauteAction(Request $request)
    {
        $refuge=new Refuge();
        $refuges=[];
        $refuges = $this->getDoctrine()->getManager()
            ->getRepository(Refuge::class)->findAll();

        $form=$this->createForm(RechercheGouvernement::class,$refuge);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()){
            $gouvernementrefuge=$refuge->getGouvernementrefuge();
            if ($gouvernementrefuge=="tout"){
                $refuges = $this->getDoctrine()->getManager()
                    ->getRepository(Refuge::class)->findAll();
            }
            else
                $refuges = $this->getDoctrine()->getManager()
                    ->getRepository(Refuge::class)->recherchegouvernement($gouvernementrefuge);
        }

        return $this->render('RefugeBundle:Refuge:afficher_refuge_internaute.html.twig',[
            'form'=>$form->createView(),'refuges'=>$refuges]);
    }

    public function AfficherRefugeAction(Request $request)
    {
        $refuge=new Refuge();
        $refuges=[];
        $refuges = $this->getDoctrine()->getManager()
            ->getRepository(Refuge::class)->findAll();

        $form=$this->createForm(RechercheGouvernement::class,$refuge);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()){
            $gouvernementrefuge=$refuge->getGouvernementrefuge();
            if ($gouvernementrefuge=="tout"){
                $refuges = $this->getDoctrine()->getManager()
                    ->getRepository(Refuge::class)->findAll();
            }
            else
                $refuges = $this->getDoctrine()->getManager()
                    ->getRepository(Refuge::class)->recherchegouvernement($gouvernementrefuge);
        }

      return $this->render('RefugeBundle:Refuge:afficher_refuge.html.twig',[
         'form'=>$form->createView(),'refuges'=>$refuges]);
    }

    public function AjouterRefugeAction(Request $request)
    {
        $refuge=new Refuge();
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $refuge->setCin($user);
            $refuge->setImmatriculation($request->get('immatriculation'));
            $refuge->setNomrefuge($request->get('nomrefuge'));
            $refuge->setEmailrefuge($request->get('emailrefuge'));
            $refuge->setTelephonerefuge($request->get('telephonerefuge'));
            $refuge->setFaxrefuge($request->get('faxrefuge'));
            $refuge->setAdresserefuge($request->get('adresserefuge'));
            $refuge->setGouvernementrefuge($request->get('gouvernementrefuge'));
            $refuge->setCodepostalerefuge($request->get('codepostalerefuge'));

            $refuge->setPhotorefuge($request->get('photorefuge'));
            $refuge->setChat($request->get('chat'));
            $refuge->setChien($request->get('chien'));
            $refuge->setRongeur($request->get('rongeur'));
            $refuge->setAutre($request->get('autre'));


            $em->persist($refuge);
            $em->flush();
            return $this->redirectToRoute('ajouter_refuge');

        }

        return $this->render('RefugeBundle:Refuge:ajouter_refuge.html.twig', array(
            // ...
        ));
    }
    public function modifierRefugeAction(Request $request,$immatriculation)
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $refuge = $em->getRepository(Refuge::class)->find($immatriculation);
        if($request->isMethod('POST')) {
            $refuge->setImmatriculation($request->get('immatriculation'));
            $refuge->setNomrefuge($request->get('nomrefuge'));
            $refuge->setEmailrefuge($request->get('emailrefuge'));
            $refuge->setTelephonerefuge($request->get('telephonerefuge'));
            $refuge->setFaxrefuge($request->get('faxrefuge'));
            $refuge->setAdresserefuge($request->get('adresserefuge'));
            $refuge->setGouvernementrefuge($request->get('gouvernementrefuge'));
            $refuge->setCodepostalerefuge($request->get('codepostalerefuge'));

            $refuge->setPhotorefuge($request->get('photorefuge'));
            $refuge->setChat($request->get('chat'));
            $refuge->setChien($request->get('chien'));
            $refuge->setRongeur($request->get('rongeur'));
            $refuge->setAutre($request->get('autre'));
            $em->persist($refuge);
            $em->flush();
            return $this->redirectToRoute('afficher_refuge_dashboard');

        }
        return $this->render('RefugeBundle:Refuge:modifierRefuge.html.twig'
        );


    }

}
