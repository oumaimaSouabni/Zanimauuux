<?php

namespace MagasinBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use MagasinBundle\Entity\Magasin;
use MagasinBundle\Repository\produitRepository ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Magasin controller.
 *
 * @Route("magasin")
 */
class MagasinController extends Controller
{
    public function afficheMagasinAction()
    {
        $magasins = $this->getDoctrine()
            ->getRepository(Magasin::class)->findAll();
        $user=$this->getUser();
        if($user==NULL) {
            return $this->render('MagasinBundle:Magasin:affiche.html.twig', ['magasins' => $magasins]);
        }
        else{
            return $this->render('MagasinBundle:Magasin:afficheConnecté.html.twig',['magasins'=>$magasins]);
        }
    }


    public function afficheMagasinPropAction()
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $magasin=new Magasin();
        $magasin->setCinProprietaireMagasin($user);
        $idUser=$magasin->getCinProprietaireMagasin();
        $em=$this->getDoctrine()->getManager();
        $magasins=$em->getRepository("MagasinBundle:Magasin")->findMagasin($idUser);


        return $this->render('MagasinBundle:Magasin:afficheMagasinProp.html.twig',
            array( 'magasins'=>$magasins));

    }

    public function ajoutMagasinAction(Request $request )
    {       $magasin=new Magasin();
            $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $magasin->setCinProprietaireMagasin($user) ;
            $magasin->setNumRC($request->get('numRC'));
            $magasin->setNomMagasin($request->get('nomMagasin'));
            $magasin->setAdresseMagasin($request->get('adresseMagasin'));
            $magasin->setVilleMagasin($request->get('villeMagasin'));
            $magasin->setCodePostaleMagasin($request->get('codePostaleMagasin'));
            $magasin->setPhotoMagasin($request->get('photoMagasin'));
            $em->persist($magasin);
            $em->flush();
            return $this->redirectToRoute('ajout_m');

        }
        return $this->render('MagasinBundle:Magasin:ajout_m.html.twig');
    }

    public function modifMagasinPropAction(Request $request,$idMagasin)
    {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository(Magasin::class)->find($idMagasin);
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        if($request->isMethod('POST')) {
                $em = $this->getDoctrine()->getManager();
                $magasin->setCinProprietaireMagasin($user) ;
                $magasin->setNumRC($request->get('numRC'));
                $magasin->setNomMagasin($request->get('nomMagasin'));
                $magasin->setAdresseMagasin($request->get('adresseMagasin'));
                $magasin->setVilleMagasin($request->get('villeMagasin'));
                $magasin->setCodePostaleMagasin($request->get('codePostaleMagasin'));
                $magasin->setPhotoMagasin($request->get('photoMagasin'));
                $em->persist($magasin);
                $em->flush();
                return $this->redirectToRoute('afficheMagasinProp');

            }
            return $this->render('MagasinBundle:Magasin:modif_m.html.twig',['magasin'=>$magasin]);

    }

    public function suppMagasinPropAction($idMagasin)
    {
        $user=$this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $Magasin=$em->getRepository(Magasin::class)
            ->find($idMagasin);
        $em->remove($Magasin);
        $em->flush();
        return $this->redirectToRoute('afficheMagasinProp');

    }
}
