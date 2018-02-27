<?php

namespace MagasinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MagasinBundle\Entity\ContenuPanier;
use MagasinBundle\Entity\Panier;
use MagasinBundle\Entity\Produit;
use MagasinBundle\Entity\Magasin;

class PanierController extends Controller
{
    public function ajouterProduitPanierAction($idProduit,$prix)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser() ;
        $cp=new ContenuPanier();
        $panier=new Panier();
        $panier2=new Panier();
        $panier2->setCin($user);
        $panier1=$em->getRepository(Panier::class)->findPanier($panier2->getCin() );
        $cp->setCommande(false);
        //on teste si le client a deja ajouter un produit au panier, donc on maj juste la somme de ses achats
        if (!empty($panier1) )
        {
            $panier1->setSomme($panier1->getSomme() +$prix);
            $em->persist($panier1);
            $em->flush();
            $cp->setCin($panier1);
        }
        else
        {
            $panier->setCin($user);
            $panier->setSomme($prix);
            $em->persist($panier);
            $em->flush();
            $cp->setCin($panier);
        }
        //on teste si le client a deja ajouter le produit X au panier, donc on MAJ juste la quantité
        $produit= $em->getRepository(ContenuPanier::class)->findProduit($idProduit,$panier2->getCin());
        if(!empty($produit))
        {
            $produit->setQuantite($produit->getQuantite()+1 );
            $produit->setCommande(false);
            $em->persist($produit);
            $em->flush();
        }
        else
        {
            $produit=$em->getRepository(Produit::class)->selectIdMagasin($idProduit);
            $cp->setQuantite(1);
            $cp->setIdProduit($produit);
            $em->persist($cp);
            $em->flush();
        }
        $produit=$em->getRepository(Produit::class)->selectIdMagasin($idProduit);
        $produit->setQuantite($produit->getQuantite()-1);
        $em->persist($produit);
        $em->flush();
            //$magasin=$em->getRepository(Magasin::class)->findIdMagasin($idProduit);
           // $var=$magasin->getIdMagasin();
        return $this->redirectToRoute('afficheProduit_m', array('idMagasin' => 3)) ;
            // ...
    }

    public function modifPanierAction($idProduit,$cin,$quantite)
    {
        $em=$this->getDoctrine()->getManager();
        $cPanier=$em->getRepository(ContenuPanier::class)->findProduit($idProduit,$cin);
        $cPanier->setQuantite($quantite);
        //$panier=$em->getRepository(Panier::class)->findPanier($cin);
        // $panier
        $em->persist($cPanier);
        $em->flush();
        echo 'ok';

    }


    public function supprimerProduitPanierAction($idContenuPanier,$prix,$quantite)
    {
        $user=$this->getUser();
        $panier=new Panier();
        $panier->setCin($user);
        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $cProduit= $em->getRepository(ContenuPanier::class)->getProduitContenuPanier($idContenuPanier) ;
        $produit= $em1->getRepository(Produit::class)->selectIdMagasin($cProduit->getIdProduit());
        $produit->setQuantite($produit->getQuantite()+$quantite);
        $em1->persist($produit);
        $em1->flush();
        $em->remove($cProduit);
        $em->flush();
        $panier1=$em->getRepository(Panier::class)->findPanier($panier->getCin() );
        $panier1->setSomme($panier1->getSomme() -($prix*$quantite));
        $em->persist($panier1);
        $em->flush();

        return $this->redirectToRoute('afficheProduit_m', array('idMagasin' => 3));
    }


    public function affichePanierAction()
    {
        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $cPanier=$em->getRepository(ContenuPanier::class)->getProduitPanier($user,0);
        $panier=$em->getRepository(Panier::class)->findPanier($user);

        return $this->render('MagasinBundle:Panier:affiche_panier.html.twig',array('cPanier'=>$cPanier,'panier'=>$panier));


    }

}
