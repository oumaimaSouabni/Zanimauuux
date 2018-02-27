<?php

namespace PetSitterDresseurBundle\Controller;

use FOS\UserBundle\Model\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use PetSitterDresseurBundle\Entity\Avis;
use PetSitterDresseurBundle\Entity\Parc;
use PetSitterDresseurBundle\Form\RechercheParc;
use PetSitterDresseurBundle\Form\Registration;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZanimauxBundle\Form\RegistrationType;


class DresseurController extends Controller
{
    //creation parc
    public function creeParcAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $parc = new Parc();
        $form = $this->createForm(Registration::class, $parc);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parc);
            $em->flush();
            return $this->redirectToRoute('redirectDresseur');
        }

        return $this->render('PetSitterDresseurBundle:Dresseur:AjoutParcs.html.twig', array(
            'user' => $user,
            'form' => $form->createView()));
    }

    //redirection pour rôle dresseur

    public function redirectAction()
    {   $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em=$this->getDoctrine();
        //repository help you fetch (read) entities of a certain class.
        $repository=$em->getRepository(Parc::class);

        $parcs=$repository->findAll();

        return $this->render('PetSitterDresseurBundle:Dresseur:dashboard_dresseur.html.twig', array(
            'user' => $user,
            'Parc'=>$parcs,
        ));
    }

    //afficher profil

    public function showAction()
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('PetSitterDresseurBundle:Dresseur:profileDresseur.html.twig', array(
            'user' => $user,
        ));
    }

    //Mise à jour profil dresseur

    public function updateAction(Request $request,$id ){
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $dresseur = $em->getRepository("ZanimauxBundle:User")->find($id);
        $form = $this->createFormBuilder($dresseur)
            ->add('username',TextType::class)
            ->add('email',TextType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('adresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('codePostale',TextType::class)
            ->add('telephone',TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Mettre à jour'))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $dresseur= $form->getData();
            $em->persist($dresseur);
            $em->flush();
            return $this->redirectToRoute('profileDresseur');

        }
        return $this->render('PetSitterDresseurBundle:Dresseur:editDresseur.html.twig', array(
                'user' => $user,
            'form' => $form->createView(),)
        );
    }

    //Page parc

    public function showParcAction(Request $request)
    {

        $parc = $this->getUser();
        if (!is_object($parc) || !$parc instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }



        return $this->render('PetSitterDresseurBundle:Dresseur:dashboard_dresseur.html.twig', array(
            'user' => $parc,
        ));
    }

    //Affichage la liste des parcs

    public function afficheParcAction()
    {
        $user = $this->getUser();
        //create our entity manager: get the service doctrine
        $em=$this->getDoctrine();
        //repository help you fetch (read) entities of a certain class.
        $repository=$em->getRepository(Parc::class);
        //find *all* 'Projet' objects
        $parcs=$repository->findAll();

        //create our entity manager: get the service doctrine
        $em=$this->getDoctrine();
        //repository help you fetch (read) entities of a certain class.
        $repository=$em->getRepository(Avis::class);
        //find *all* 'Projet' objects
        $avis=$repository->findAll();
        //render a template with the list of objects
        return $this->render('PetSitterDresseurBundle:Dresseur:Parcs.html.twig', array(
            'user' => $user,
            'Parc'=>$parcs,

        ));
    }


    public function consulterParcAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $parc = $em->getRepository("ZanimauxBundle:Parc")->find($id);
        //repository help you fetch (read) entities of a certain class.
        $repository=$em->getRepository(Parc::class);
        //find *all* 'Projet' objects
        $parcs=$repository->findAll();

        //create our entity manager: get the service doctrine
        $em=$this->getDoctrine();
        //repository help you fetch (read) entities of a certain class.
        $repository=$em->getRepository(Avis::class);
        //find *all* 'Projet' objects
        $avis=$repository->findAll();
        //render a template with the list of objects
        return $this->render('PetSitterDresseurBundle:Dresseur:ConsulterParc.html.twig', array(
            'user' => $user,
            'parcs'=>$parcs,

        ));
    }

    //Mise à jour parc

    public function updateParcAction(Request $request,$id ){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }



        $em = $this->getDoctrine()->getManager();
        $parc = $em->getRepository("PetSitterDresseurBundle:Parc")->find($id);
        $form = $this->createFormBuilder($parc)
            ->add('nomParc',TextType::class)
            ->add('adresseParc',TextType::class)
            ->add('villeParc',TextType::class)
            ->add('codePostaleParc',TextType::class)
            ->add('CategorieDressage',ChoiceType::class, array(
                'choices' => array(
                    'Chien'=> 'Chien',
                    'Chevaux' => 'Chevaux',
                    'Autre' => 'Autre',
                )))
            ->add('save', SubmitType::class, array('label' => 'Mettre à jour'))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $parc= $form->getData();
            $em->persist($parc);
            $em->flush();
            return $this->redirectToRoute('redirectDresseur');

        }
        return $this->render('PetSitterDresseurBundle:Dresseur:EditParc.html.twig', array(
                'user' => $user,
            'form' => $form->createView(),
            'parc'=>$parc
        ));
    }

    //Effacer parc

    public function deleteParcAction($id){
        $em = $this->getDoctrine()->getManager();
        $parc = $em->getRepository("PetSitterDresseurBundle:Parc")->find($id);
        $em->remove($parc);
        $em->flush();
        return $this->redirectToRoute('redirectDresseur',['parc'=>$parc]);
    }

    /*
public function rechearcheParcAction (Request $request){

    $parc = new Parc();
    $em = $this->getDoctrine()->getManager();
    $Form = $this->createForm(RechercheParc::class,$parc);
    $Form->handleRequest($request);
    if ($Form->isValid()){
        $parc=$em->getRepository('ZanimauxBundle:Parc')->findBy(array(
            'nomParc'=>$parc->getNomParc(),
            'adresseParc'=>$parc->getAdresseParc(),
            'CategorieDressage'=>$parc->getCategorieDressage()
        ));

    }else{
        $parc=$em->getRepository('ZanimauxBundle:Parc')->findAll();
    }
    return $this->render('ZanimauxBundle:Dresseur:dashboard_dresseur.html.twig', array(
        'Form'=>$Form->createView(),
        'Parc'=>$parc
    ));

}
    */

    public function rechercheAction(){
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $parcs = $em->getRepository("PetSitterDresseurBundle:Parc")->findParcDQL($_GET['chose']);

        return $this->render('PetSitterDresseurBundle:Dresseur:dashboard_dresseur.html.twig',array(
            'user' => $user,
             'Parc'=>$parcs));
    }


    public function ratingAction($id,$val)
    {
        global $kernel;
        $user = $kernel->getContainer()->get('security.token_storage')->getToken()->getUser();
        if ($user !== 'anon.') {
            $em = $this->getDoctrine()->getManager();
            $avis = $em->getRepository('PetSitterDresseurBundle:Avis')->findOneBy(array('idParc' => $id,'cinUser'=>$user));

            $u=$avis->getIduser();
            $em->remove($avis);
            $em->flush();

            $avis=new Avis();
            $avis->setcinUser($u);
            $avis->setIdParc($id);
            $avis->setAvis($val);
            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute('rating', array('id' => $avis->getIdParc()));
        }
        else
            return $this->redirectToRoute('rating');

    }



}

