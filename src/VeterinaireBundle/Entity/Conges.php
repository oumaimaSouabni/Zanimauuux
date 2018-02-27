<?php

namespace VeterinaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZanimauxBundle\Entity\User;

/**
 * Conges
 *
 * @ORM\Table(name="conges")
 * @ORM\Entity(repositoryClass="VeterinaireBundle\Repository\CongesRepository")
 */
class Conges
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getImmatriculecabinet()
    {
        return $this->immatriculecabinet;
    }

    /**
     * @param mixed $immatriculecabinet
     */
    public function setImmatriculecabinet($immatriculecabinet)
    {
        $this->immatriculecabinet = $immatriculecabinet;
    }

    /**
     * @return \DateTime
     */
    public function getDateconges()
    {
        return $this->dateconges;
    }

    /**
     * @param \DateTime $dateconges
     */
    public function setDateconges($dateconges)
    {
        $this->dateconges = $dateconges;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Cabinet")
     * @ORM\JoinColumn(name="immatriculecabinet", referencedColumnName="immatriculecabinet")
     */
    private $immatriculecabinet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateconges", type="datetime", nullable=false)
     */
    private $dateconges;
}

