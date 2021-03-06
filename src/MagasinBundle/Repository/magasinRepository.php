<?php

namespace MagasinBundle\Repository;

/**
 * magasinRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class magasinRepository extends \Doctrine\ORM\EntityRepository
{

    public function findMagasin($idUser){

        $query=$this->getEntityManager()
            ->createQuery("
                      select p from MagasinBundle:Magasin p WHERE p.cinProprietaireMagasin =:idProp
                      ")
            ->setParameter('idProp',$idUser);
        return $query->getResult() ;
    }
    public function rechercheParCinDQL($cin){
        $q=$this->getEntityManager()
            ->createQuery("select a from MagasinBundle:Magasin a
                               WHERE a.cinProprietaireMagasin=:cin  ")
            ->setParameter('cin',$cin);
        return $q->getResult();}
        //c'est pour trouver l'id du magasin: pour redirectToRoute de l'action ajouterProduitPanierAction($idProduit,$prix)
        public function findIdMagasin($idProduit){

            $q = $this->getEntityManager()
                ->createQuery("SELECT p from MagasinBundle:Magasin p
                               WHERE p.idMagasin IN 
                               (SELECT m.idMagasin from MagasinBundle:Produit m 
                                WHERE m.idProduit=:idProduit)")->setParameter('idProduit',$idProduit);
            return $q->getOneOrNullResult();
        }

}