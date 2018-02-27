<?php
/**
 * Created by PhpStorm.
 * User: Maroua
 * Date: 20/02/2018
 * Time: 00:16
 */

namespace EventAndAnnonceBundle\Repository;


class evenementRepository extends \Doctrine\ORM\EntityRepository {
    public function rechercherEvenementByTitre($motcle){
    $query= $this->createQueryBuilder('e')
    ->where('e.titre like :titre')->orWhere('e.lieu like :titre')->orWhere('e.type like :titre')
    ->setParameter('titre',$motcle.'%')
    ->orderBy('e.titre','ASC')->getQuery();

    return $query->getResult();

}

    public function updateNbParticipantsAfterAnnulation($idEvt){
        $query=$this->getEntityManager()->createQuery('UPDATE EventAndAnnonceBundle:Evenement p set p.nbParticipants =(p.nbParticipants - 1) WHERE p.idEvt= :idEvt')
            ->setParameter('idEvt',$idEvt);
        $query->execute();
    }

    public function updateNbParticipants($idEvt){
        $query=$this->getEntityManager()->createQuery('UPDATE EventAndAnnonceBundle:Evenement p set p.nbParticipants =(p.nbParticipants + 1) WHERE  p.idEvt= :idEvt')
            ->setParameter('idEvt',$idEvt);
        $query->execute();
    }



}