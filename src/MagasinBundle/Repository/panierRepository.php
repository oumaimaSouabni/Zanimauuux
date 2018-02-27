<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 19/02/2018
 * Time: 12:56 AM
 */

namespace MagasinBundle\Repository;


use Doctrine\ORM\EntityRepository;

class panierRepository extends EntityRepository
{
    //get le panier d'un client ayant le CIN $cin
    public function findPanier($cin)
    {
        $q = $this->getEntityManager()
            ->createQuery(" select p from MagasinBundle:Panier p 
                                WHERE p.cin =:cin")
            ->setParameter('cin', $cin);
        return $q->getOneOrNullResult() ;

    }

}