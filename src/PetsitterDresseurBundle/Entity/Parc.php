<?php

namespace PetSitterDresseurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parc
 *
 * @ORM\Table(name="parc")
 * @ORM\Entity(repositoryClass="PetSitterDresseurBundle\Repository\ParcRepository")
 */
class Parc
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
     * @var string
     *
     * @ORM\Column(name="nomParc", type="string", length=20, nullable=true)
     */
    private $nomParc;

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cinDresseur",referencedColumnName="cin")
     */
    private $cinDresseur;

    /**
     * @var string
     *
     * @ORM\Column(name="CategorieDressage", type="string", nullable=true)
     */
    private $CategorieDressage;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseParc", type="string", length=20, nullable=true)
     */
    private $adresseParc;

    /**
     * @var string
     *
     * @ORM\Column(name="villeParc", type="string", length=20, nullable=true)
     */
    private $villeParc;

    /**
     * @var integer
     *
     * @ORM\Column(name="codePostaleParc", type="integer", nullable=true)
     */
    private $codePostaleParc;

    /**
     * @var string
     *
     * @ORM\Column(name="photoParc", type="string", length=65535, nullable=true)
     */
    private $photoParc;


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
     * Set nomParc
     *
     * @param string $nomParc
     *
     * @return Parc
     */
    public function setNomParc($nomParc)
    {
        $this->nomParc = $nomParc;

        return $this;
    }

    /**
     * Get nomParc
     *
     * @return string
     */
    public function getNomParc()
    {
        return $this->nomParc;
    }

    /**
     * Set categorieDressage
     *
     * @param string $categorieDressage
     *
     * @return Parc
     */
    public function setCategorieDressage($categorieDressage)
    {
        $this->CategorieDressage = $categorieDressage;

        return $this;
    }

    /**
     * Get categorieDressage
     *
     * @return string
     */
    public function getCategorieDressage()
    {
        return $this->CategorieDressage;
    }

    /**
     * Set adresseParc
     *
     * @param string $adresseParc
     *
     * @return Parc
     */
    public function setAdresseParc($adresseParc)
    {
        $this->adresseParc = $adresseParc;

        return $this;
    }

    /**
     * Get adresseParc
     *
     * @return string
     */
    public function getAdresseParc()
    {
        return $this->adresseParc;
    }

    /**
     * Set villeParc
     *
     * @param string $villeParc
     *
     * @return Parc
     */
    public function setVilleParc($villeParc)
    {
        $this->villeParc = $villeParc;

        return $this;
    }

    /**
     * Get villeParc
     *
     * @return string
     */
    public function getVilleParc()
    {
        return $this->villeParc;
    }

    /**
     * Set codePostaleParc
     *
     * @param integer $codePostaleParc
     *
     * @return Parc
     */
    public function setCodePostaleParc($codePostaleParc)
    {
        $this->codePostaleParc = $codePostaleParc;

        return $this;
    }

    /**
     * Get codePostaleParc
     *
     * @return integer
     */
    public function getCodePostaleParc()
    {
        return $this->codePostaleParc;
    }

    /**
     * Set photoParc
     *
     * @param string $photoParc
     *
     * @return Parc
     */
    public function setPhotoParc($photoParc)
    {
        $this->photoParc = $photoParc;

        return $this;
    }

    /**
     * Get photoParc
     *
     * @return string
     */
    public function getPhotoParc()
    {
        return $this->photoParc;
    }

    /**
     * Set cinDresseur
     *
     * @param \ZanimauxBundle\Entity\User $cinDresseur
     *
     * @return Parc
     */
    public function setCinDresseur(\ZanimauxBundle\Entity\User $cinDresseur = null)
    {
        $this->cinDresseur = $cinDresseur;

        return $this;
    }

    /**
     * Get cinDresseur
     *
     * @return \ZanimauxBundle\Entity\User
     */
    public function getCinDresseur()
    {
        return $this->cinDresseur;
    }
}
