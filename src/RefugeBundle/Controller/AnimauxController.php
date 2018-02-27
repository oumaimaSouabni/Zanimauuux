<?php

namespace RefugeBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use RefugeBundle\Entity\Animal;
use RefugeBundle\Entity\Commentaires;
use RefugeBundle\Entity\Refuge;
use ZanimauxBundle\Entity\User;
use RefugeBundle\Form\AnimalType;

class AnimauxController extends Controller
{
    public function AjouterAnimalAction(Request $request){


        $animal=new Animal();
        $form=$this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('afficher_animaux');
        }
        return $this->render('RefugeBundle:Animaux:ajouter_animal.html.twig', array('form'=>$form->createView()
        ));
    }

    public function AjouterAnimal2Action(Request $request)
    {
        $animal=new Animal();
        if($request->isMethod('POST')) {
            $animal->setNomanimal($request->get('nomAnimal'));
            $animal->setType($request->get('type'));
            $animal->setEtat($request->get('etat'));
            $animal->setAge($request->get('age'));
            $animal->setRace($request->get('race'));
            $animal->setRefuge($request->get('refuge'));

            $animal->setPhotoanimal($request->get('photoanimal'));


            $em = $this->getDoctrine()->getManager();
            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('afficher_animaux');
        }

        return $this->render('RefugeBundle:Animaux:ajouter_animal.html.twig', array(
            // ...
        ));
    }

    public function AfficherAnimaux2Action()
    {
        $em=$this->getDoctrine()->getManager();
        $animaux=$em->getRepository("ZanimauxBundle:Animal")->rechercheParImmatriculationDQL("123456");


        return $this->render('RefugeBundle:Animaux:afficher_animaux.html.twig',
            array( 'animaux'=>$animaux));
    }
    public function deleteAnimalAction($idAnimal){

        $em = $this->getDoctrine()->getManager();
        $animal=$em->getRepository(Animal::class)
            ->find($idAnimal);
        $em->remove($animal);
        $em->flush();
        return $this->redirectToRoute('afficher_animaux');
    }
    public function updateAnimal2Action( Request $request,$idAnimal){
        $em = $this->getDoctrine()->getManager();

        $animal = $em->getRepository(Animal::class)->find($idAnimal);

        $form = $this->createForm(AnimalType::class,$animal);


        $form->handleRequest($request);

        if($form->isSubmitted()){

            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('afficher_animaux');

        }
        return $this->render('RefugeBundle:Animaux:updateAnimal.html.twig',array('form'=>$form->createView()
    ));

    }
    public function updateAnimalAction($idAnimal, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $animal=$em->getRepository(Animal::class)->find($idAnimal);
        $form=$this->createFormBuilder($animal)
            ->add('type',TextType::class,array('label'=>'Type:'))
            ->add('etat',TextType::class,array('label'=>'Etat:'))
            ->add('nomanimal',TextType::class,array('label'=>'Nom animal:'))

            ->add('age',TextType::class,array('label'=>'Age animal:'))
            ->add('race',TextType::class,array('label'=>'Race:'))
            ->add('refuge',EntityType::class
                , array('class'=>'ZanimauxBundle\Entity\Refuge','choice_label'=>'immatriculation','multiple'=>false))
            ->add('Modifier',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid() ){
            $evenement = $form->getData();
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute('afficher_animaux');

        }

        return $this->render('RefugeBundle:Animaux:updateAnimal.html.twig', array('animal'=>$animal,'form'=>$form->createView()

        ));
    }
    public function AfficherAnimauxAction()

    {

        $user=$this->getUser();
        $refuge=new Refuge();
        $refuge->setCin($user);
        $idUser=$refuge->getCin();
        $animaux = $this->getDoctrine()
            ->getRepository(Animal::class)->findIdRefuge($idUser) ;

        return $this->render('RefugeBundle:Animaux:afficher_animaux.html.twig',['animaux'=>$animaux]);
    }

    public function afficheAnimalPourInternauteAction($immatriculation)
    {
        $em = $this->getDoctrine()->getManager();
        $refuge=$em->getRepository(Refuge::class)->find($immatriculation);
        $animaux=$em->getRepository('ZanimauxBundle:Animal')->rechercheParImmatriculationDQL($immatriculation) ;
        $em3=$this->getDoctrine()->getManager();
        $commentaires=$em3->getRepository("ZanimauxBundle:Commentaires")
            ->rechercheCommentairesImmatriculationDQL($immatriculation);

        return $this->render('RefugeBundle:Animaux:afficher_animaux_internaute.html.twig',['animaux'=>$animaux, 'commentaires'=>$commentaires,'refuge'=>$refuge]);

    }
    public function afficheAnimalPourClientAction(Request $request,$immatriculation)
    {

        $user=$this->getUser();
        $refuge=new Refuge();
        $refuge->setCin($user);
        $idUser=$refuge->getCin();
        $em = $this->getDoctrine()->getManager();
        $refuge=$em->getRepository(Refuge::class)->find($immatriculation);
        $animaux=$em->getRepository('ZanimauxBundle:Animal')->rechercheParImmatriculationDQL($immatriculation) ;
        $commentaire=new Commentaires();
        if($request->isMethod('POST')) {
            $commentaire->setContenant($request->get('contenant'));
            $commentaire->setDate($this->date = new \DateTime('now'));
            $commentaire->setCin($idUser);
            $commentaire->setRefuge($refuge);
            $em2 = $this->getDoctrine()->getManager();
            $em2->persist($commentaire);
            $em2->flush();
        }
        $em3=$this->getDoctrine()->getManager();
        $commentaires=$em3->getRepository("ZanimauxBundle:Commentaires")
            ->rechercheCommentairesImmatriculationDQL($immatriculation);


        return $this->render('RefugeBundle:Animaux:afficher_animaux_client.html.twig',['animaux'=>$animaux, 'commentaires'=>$commentaires, 'idUser'=>$idUser,'refuge'=>$refuge]);

    }
    public function modifierCommentaireAction(Request $request,$id){
        $user=$this->getUser();
        $refuge=new Refuge();
        $refuge->setCin($user);
        $idUser=$refuge->getCin();
        $em = $this->getDoctrine()->getManager();
        $commentaire= $em->getRepository(Commentaires::class)->find($id);
        $immatriculation=$commentaire->getRefuge();
        $refuge=$em->getRepository(Refuge::class)->find($immatriculation);
        $imm=$refuge->getImmatriculation();
        $animaux=$em->getRepository('ZanimauxBundle:Animal')->rechercheParImmatriculationDQL($immatriculation) ;
        if($request->isMethod('POST')) {
            $immatriculation=$commentaire->getRefuge();
            $commentaire->setContenant($request->get('contenant'));
            $commentaire->setDate($this->date = new \DateTime('now'));
            $commentaire->setCin($idUser);
            $commentaire->setRefuge($refuge);
            $em2 = $this->getDoctrine()->getManager();
            $em2->persist($commentaire);
            $em2->flush();
            return $this->redirectToRoute('affiche_animaux_client',['immatriculation'=>$imm]);
        }
        $em3=$this->getDoctrine()->getManager();
        $commentaires=$em3->getRepository("RefugeBundle:Commentaires")
            ->rechercheCommentairesImmatriculationDQL($immatriculation);


        return $this->render('RefugeBundle:Animaux:modifier_commentaire_client.html.twig',['animaux'=>$animaux,'commentaire'=>$commentaire,'commentaires'=>$commentaires, 'idUser'=>$idUser,'refuge'=>$refuge]);

    }


    public function supprimerCommentaireAction($id){

        $em = $this->getDoctrine()->getManager();
        $commentaire= $em->getRepository(Commentaires::class)->find($id);
        $immatriculation=$commentaire->getRefuge();
        $refuge=$em->getRepository(Refuge::class)->find($immatriculation);
        $imm=$refuge->getImmatriculation();
        $em->remove($commentaire);
        $em->flush();
        return $this->redirectToRoute('affiche_animaux_client',['immatriculation'=>$imm]);
    }






}
