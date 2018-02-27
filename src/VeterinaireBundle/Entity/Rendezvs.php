<?php

namespace VeterinaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZanimauxBundle\Entity\User;

/**
 * Rendezvs
 *
 * @ORM\Table(name="rendezvs")
 * @ORM\Entity(repositoryClass="VeterinaireBundle\Repository\RendezvsRepository")
 */
class Rendezvs
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrdv", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idrdv;

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;
    /**
     * @ORM\ManyToOne(targetEntity="Cabinet")
     * @ORM\JoinColumn(name="immatriculecabinet", referencedColumnName="immatriculecabinet")
     */
    private $immatriculecabinet;

    /**
     * @return int
     */
    public function getIdrdv()
    {
        return $this->idrdv;
    }

    /**
     * @param int $idrdv
     */
    public function setIdrdv($idrdv)
    {
        $this->idrdv = $idrdv;
    }

    /**
     * @return mixed
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param mixed $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
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
    public function getHeurerdv()
    {
        return $this->heurerdv;
    }

    /**
     * @param \DateTime $heurerdv
     */
    public function setHeurerdv($heurerdv)
    {
        $this->heurerdv = $heurerdv;
    }
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurerdv", type="datetime", nullable=false)
     */
    private $heurerdv;
}

