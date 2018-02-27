<?php

namespace MagasinBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use MagasinBundle\Entity\ContenuPanier;
use MagasinBundle\Entity\Magasin;
use MagasinBundle\Entity\Panier;
use MagasinBundle\Entity\Produit;
use MagasinBundle\Entity\Rate;
use MagasinBundle\Form\ProduitType;
use MagasinBundle\Repository\ProduitRepository;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{

    public function afficheProduitMAction($idMagasin)
    {
        {
            $user=$this->getUser() ;
            $em = $this->getDoctrine()->getManager();
            $produits=$em->getRepository('MagasinBundle:Produit')->findProduit($idMagasin) ;
            if($user==NULL)
            {return $this->render('MagasinBundle:Produit:affiche_pr.html.twig',array('produits'=>$produits)); }
            else{
                //pour passer le contenu du panier et la somme du panier pour qu'on puisse les afficher dzns le header
                $cPanier=$em->getRepository(ContenuPanier::class)->getProduitPanier($user,0);
                $panier=$em->getRepository(Panier::class)->findPanier($user);
                //si le client n'a pas encore de panier
                if(empty($panier))
                {
                    $panier=new Panier();
                    $panier->setSomme(0);
                }

                return $this->render('MagasinBundle:Produit:affiche_prConnecté.html.twig',array('produits'=>$produits,'cPanier'=>$cPanier,'panier'=>$panier));
            }}
    }




    public function afficheProduitMDashAction()

    {
        $user=$this->getUser();
        $magasin=new Magasin();
        $magasin->setCinProprietaireMagasin($user);
        $idUser=$magasin->getCinProprietaireMagasin();
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)->findIdMagasin($idUser) ;

        return $this->render('MagasinBundle:Produit:gere_pr.html.twig',['produits'=>$produits]);
    }

    public function ajoutProduitMAction(Request $request)
    {

        $produit=new Produit();
        $form=$this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('affichePrduit_mDash');

    }
        return $this->render('MagasinBundle:Produit:ajout_produit.html.twig',array('form'=>$form->createView()
        ));
    }

    public function modifProduitMAction(Request $request,$idProduit)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($idProduit);
        if($request->isMethod('POST')) {
            $produit->setLibelle($request->get('libelle'));
            $produit->setMarque($request->get('marque'));
            $produit->setPrix($request->get('prix'));
            $produit->setPhotoProduit($request->get('photoProduit'));
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('affichePrduit_mDash');

        }
        return $this->render('MagasinBundle:Produit:modif_produit.html.twig',['produit'=>$produit,]
        );


    }

    public function suppProduitMAction($idProduit)
    {
        $em = $this->getDoctrine()->getManager();
        $produit=$em->getRepository(Produit::class)
            ->find($idProduit);
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('affichePrduit_mDash');

    }


}
