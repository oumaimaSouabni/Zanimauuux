<?php

namespace EventAndAnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="EventAndAnnonceBundle\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idParticipation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idParticipation;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string")
     */
    private $cin;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEvt", type="integer")
     */
    private $idEvt;




    /**
     * Get idParticipation
     *
     * @return integer
     */
    public function getIdParticipation()
    {
        return $this->idParticipation;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Participation
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set idEvt
     *
     * @param integer $idEvt
     *
     * @return Participation
     */
    public function setIdEvt($idEvt)
    {
        $this->idEvt = $idEvt;

        return $this;
    }

    /**
     * Get idEvt
     *
     * @return integer
     */
    public function getIdEvt()
    {
        return $this->idEvt;
    }
}
