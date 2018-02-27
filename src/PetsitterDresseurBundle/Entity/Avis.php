<?php

namespace PetSitterDresseurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="PetSitterDresseurBundle\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cinUser",referencedColumnName="cin")
     */
    private $cinUser;


    /**
     * @ORM\ManyToOne(targetEntity="PetSitterDresseurBundle\Entity\Parc")
     * @ORM\JoinColumn(name="idParc",referencedColumnName="id")
     */
    private $idParc;


    /**
     * @var integer
     *
     * @ORM\Column(name="avis", type="integer", length=20, nullable=true)
     */
    private $avis;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cinUser
     *
     * @param \ZanimauxBundle\Entity\User $cinUser
     *
     * @return Avis
     */
    public function setCinUser(\ZanimauxBundle\Entity\User $cinUser = null)
    {
        $this->cinUser = $cinUser;

        return $this;
    }

    /**
     * Get cinUser
     *
     * @return \ZanimauxBundle\Entity\User
     */
    public function getCinUser()
    {
        return $this->cinUser;
    }

    /**
     * Set idParc
     *
     * @param \PetSitterDresseurBundle\Entity\Parc $idParc
     *
     * @return Avis
     */
    public function setIdParc(\PetSitterDresseurBundle\Entity\Parc $idParc = null)
    {
        $this->idParc = $idParc;

        return $this;
    }

    /**
     * Get idParc
     *
     * @return \PetSitterDresseurBundle\Entity\Parc
     */
    public function getIdParc()
    {
        return $this->idParc;
    }

    /**
     * Set avis
     *
     * @param integer $avis
     *
     * @return Avis
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return integer
     */
    public function getAvis()
    {
        return $this->avis;
    }
}
