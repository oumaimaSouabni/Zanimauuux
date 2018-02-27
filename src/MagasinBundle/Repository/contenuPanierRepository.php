<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 19/02/2018
 * Time: 10:18 PM
 */

namespace MagasinBundle\Repository;
use Doctrine\ORM\EntityRepository;


class contenuPanierRepository extends EntityRepository
{
    //por verifier si un client de CIN $cin a acheté un produit d'id $idProduit
    public function findProduit($idProduit,$cin)
    {
        $q = $this->getEntityManager()
            ->createQuery(" select p from MagasinBundle:ContenuPanier p 
                                WHERE p.idProduit =:idProduit AND  p.cin=:cin AND p.commande=0")
            ->setParameter('idProduit', $idProduit)->setParameter('cin',$cin) ;
        return $q->getOneOrNullResult() ;


    }
    //pour recuperer le contenu d'un panier/Commande d'un utilistateur

    public function  getProduitPanier($cin,$commande)
    {
        $q = $this->getEntityManager()
            ->createQuery(" select c from MagasinBundle:ContenuPanier c
                                WHERE c.cin =:cin AND c.commande=:commande")
            ->setParameter('cin', $cin)->setParameter('commande',$commande);
        return $q->getResult() ;

    }


    //pour recuperer un produit de ContenuPanier ayant un id $idContenuPanier

    public function  getProduitContenuPanier($idContenuPanier)
    {
        $q = $this->getEntityManager()
            ->createQuery(" select c from MagasinBundle:ContenuPanier c
                                WHERE c.idContenuPanier =:idContenuPanier")
            ->setParameter('idContenuPanier', $idContenuPanier);
        return $q->getOneOrNullResult() ;

    }
    public function findMinDateCommande($cin)
    {
        $q = $this->getEntityManager()
            ->createQuery(" select MIN(c.dateCommande) from MagasinBundle:ContenuPanier c
                                WHERE c.cin =:cin AND c.commande=1")
            ->setParameter('cin', $cin);
        return $q->getOneOrNullResult() ;
    }

}