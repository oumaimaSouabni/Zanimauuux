<?php

namespace PetSitterDresseurBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use PetSitterDresseurBundle\Entity\Promenade;
use PetSitterDresseurBundle\Form\PromenadeType;

class PetSitterController extends Controller
{
    public function redirectAction()
    {     $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        //create our entity manager: get the service doctrine
        $em=$this->getDoctrine();
        //repository help you fetch (read) entities of a certain class.
        $repository=$em->getRepository(Promenade::class);
        //find *all* 'Promenade' objects
        $promenades=$repository->findAll();

        return $this->render('PetSitterDresseurBundle:PetSitter:dashboard_PetSitter.html.twig', array(
            'user' => $user,
            'Promenade' => $promenades
        ));
    }
    public function creePromenadeAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $promenade = new Promenade();
        $form = $this->createForm(PromenadeType::class,$promenade);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($promenade);
            $em->flush();
            return $this->redirectToRoute('redirectPetSitter');
        }

        return $this->render('PetSitterDresseurBundle:PetSitter:AjoutPromenade.html.twig', array(
            'user' => $user,
            'form' => $form->createView()));
    }
    public function deletePromenadeAction($id){
        $em = $this->getDoctrine()->getManager();
        $promenade = $em->getRepository("PetSitterDresseurBundle:Promenade")->find($id);
        $em->remove($promenade);
        $em->flush();
        return $this->redirectToRoute('redirectPetSitter',['promenade'=>$promenade]);
    }
    public function updatePromenadeAction(Request $request,$id ){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }



        $em = $this->getDoctrine()->getManager();
        $promenade = $em->getRepository("PetSitterDresseurBundle:Promenade")->find($id);
        $form = $this->createFormBuilder($promenade)
            ->add('nomPromenade',TextType::class)
            ->add('lieuPromenade',TextType::class)
            ->add('typePromenade',ChoiceType::class, array(
                'choices' => array(
                    'Promenade'=> 'Promenade',
                    'Garde' => 'Garde',
                    'Autre' => 'Autre',
                )))
            ->add('descriptionPromenade',TextType::class)
            ->add('datedebutPromenade')
            ->add('datefinPromenade')

            ->add('Ajouter', SubmitType::class, array('label' => 'Mettre à jour'))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $promenade= $form->getData();
            $em->persist($promenade);
            $em->flush();
            return $this->redirectToRoute('redirectPetSitter');

        }
        return $this->render('PetSitterDresseurBundle:PetSitter:EditPromenade.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'promenade'=>$promenade
        ));
    }
    public function rechercheAction (){
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $promenade = $em->getRepository("PetSitterDresseurBundle:Promenade")->findPromenadeDQL($_GET['chose']);

        return $this->render('PetSitterDresseurBundle:PetSitter:dashboard_PetSitter.html.twig',array(
            'user' => $user,
            'Promenade'=>$promenade));
    }
}
