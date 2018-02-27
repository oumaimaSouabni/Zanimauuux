<?php
namespace RefugeBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: Azza
 * Date: 2/11/2018
 * Time: 3:50 PM
 */

class AnimalRepository extends EntityRepository
{

    public function rechercheParImmatriculationDQL($refuge){
        $q=$this->getEntityManager()
            ->createQuery("select a from RefugeBundle:Animal a
                               WHERE a.refuge=:refuge  ")
            ->setParameter('refuge',$refuge);
        return $q->getResult();}



    public function findIdRefuge($idProp)
    {

        $q = $this->getEntityManager()
            ->createQuery("SELECT p from RefugeBundle:Animal p
                               WHERE p.refuge IN 
                               (SELECT m.immatriculation from RefugeBundle:Refuge m 
                                WHERE m.cin=:idProp)")->setParameter('idProp',$idProp);
        return $q->getResult();

    }

}