<?php

/**
 * Created by PhpStorm.
 * User: Azza
 * Date: 2/13/2018
 * Time: 9:43 PM
 */

namespace RefugeBundle\Repository;


use Doctrine\ORM\EntityRepository;

class RefugeRepository extends EntityRepository
{
    public function rechercheParCinDQL($cin){
        $q=$this->getEntityManager()
            ->createQuery("select a from RefugeBundle:Refuge a
                               WHERE a.cin=:cin  ")
            ->setParameter('cin',$cin);
        return $q->getResult();}
    public function recherchegouvernement($gouvernementrefuge){
        $q=$this->getEntityManager()
            ->createQuery("select v from RefugeBundle:Refuge v
                               WHERE v.gouvernementrefuge=:gouvernementrefuge ")
            ->setParameter('gouvernementrefuge',$gouvernementrefuge);
        return $q->getResult();
    }

}