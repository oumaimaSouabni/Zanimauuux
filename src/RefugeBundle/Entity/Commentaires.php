<?php

namespace RefugeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires")
 * @ORM\Entity(repositoryClass="RefugeBundle\Repository\CommentairesRepository")
 */
class Commentaires
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
     * @return mixed
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @ORM\ManyToOne(targetEntity="RefugeBundle\Entity\Refuge" )
     * @ORM\JoinColumn(name="refuge", referencedColumnName="immatriculation")
     */
    private $refuge;

    /**
     * @return mixed
     */
    public function getRefuge()
    {
        return $this->refuge;
    }

    /**
     * @param mixed $refuge
     */
    public function setRefuge($refuge)
    {
        $this->refuge = $refuge;
    }

    /**
     * @param mixed $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User" )
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="contenant", type="string", length=255)
     */
    private $contenant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


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
     * Set contenant
     *
     * @param string $contenant
     *
     * @return Commentaires
     */
    public function setContenant($contenant)
    {
        $this->contenant = $contenant;

        return $this;
    }

    /**
     * Get contenant
     *
     * @return string
     */
    public function getContenant()
    {
        return $this->contenant;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commentaires
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

