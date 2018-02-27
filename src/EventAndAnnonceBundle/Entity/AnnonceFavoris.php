<?php

namespace EventAndAnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnonceFavoris
 *
 * @ORM\Table(name="annonce_favoris")
 * @ORM\Entity(repositoryClass="EventAndAnnonceBundle\Repository\AnnonceFavorisRepository")
 */
class AnnonceFavoris
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
     * @var int
     *
     * @ORM\Column(name="idA", type="integer")
     */
    private $idA;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=255)
     */
    private $cin;


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
     * Set idA
     *
     * @param integer $idA
     *
     * @return AnnonceFavoris
     */
    public function setIdA($idA)
    {
        $this->idA = $idA;

        return $this;
    }

    /**
     * Get idA
     *
     * @return int
     */
    public function getIdA()
    {
        return $this->idA;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return AnnonceFavoris
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
}

