<?php

namespace MagasinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasin
 *
 * @ORM\Table(name="Magasin")
 * @ORM\Entity(repositoryClass="MagasinBundle\Repository\magasinRepository")
 */
class Magasin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMagasin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMagasin;
    /**
     * @var string
     *
     * @ORM\Column(name="numRC", type="string", length=20, nullable=false)
     */
    private $numRC;

    /**
     * @var string
     *
     * @ORM\Column(name="nomMagasin", type="string", length=20, nullable=false)
     */
    private $nomMagasin;

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cinProprietaireMagasin", referencedColumnName="cin")
     */
    private $cinProprietaireMagasin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbProduit", type="integer", nullable=true)
     */
    private $nbProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMagasin", type="string", length=20, nullable=false)
     */
    private $adresseMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="villeMagasin", type="string", length=20, nullable=false)
     */
    private $villeMagasin;

    /**
     * @var integer
     *
     * @ORM\Column(name="codePostaleMagasin", type="integer", nullable=false)
     */
    private $codePostaleMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="photoMagasin", type="string", nullable=true)
     */
    private $photoMagasin;

    /**
     * @ORM\OneToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="bestSellerMagasin", referencedColumnName="idProduit")
     */
    private $bestSellerMagasin;

    /**
     * @return int
     */
    public function getIdMagasin()
    {
        return $this->idMagasin;
    }

    /**
     * @param int $idMagasin
     */
    public function setIdMagasin($idMagasin)
    {
        $this->idMagasin = $idMagasin;
    }

    /**
     * @return string
     */
    public function getNumRC()
    {
        return $this->numRC;
    }

    /**
     * @param string $numRC
     */
    public function setNumRC($numRC)
    {
        $this->numRC = $numRC;
    }

    /**
     * @return string
     */
    public function getNomMagasin()
    {
        return $this->nomMagasin;
    }

    /**
     * @param string $nomMagasin
     */
    public function setNomMagasin($nomMagasin)
    {
        $this->nomMagasin = $nomMagasin;
    }

    /**
     * @return string
     */
    public function getCinProprietaireMagasin()
    {
        return $this->cinProprietaireMagasin;
    }

    /**
     * @param string $cinProprietaireMagasin
     */
    public function setCinProprietaireMagasin($cinProprietaireMagasin)
    {
        $this->cinProprietaireMagasin = $cinProprietaireMagasin;
    }

    /**
     * @return int
     */
    public function getNbProduit()
    {
        return $this->nbProduit;
    }

    /**
     * @param int $nbProduit
     */
    public function setNbProduit($nbProduit)
    {
        $this->nbProduit = $nbProduit;
    }

    /**
     * @return string
     */
    public function getAdresseMagasin()
    {
        return $this->adresseMagasin;
    }

    /**
     * @param string $adresseMagasin
     */
    public function setAdresseMagasin($adresseMagasin)
    {
        $this->adresseMagasin = $adresseMagasin;
    }

    /**
     * @return string
     */
    public function getVilleMagasin()
    {
        return $this->villeMagasin;
    }

    /**
     * @param string $villeMagasin
     */
    public function setVilleMagasin($villeMagasin)
    {
        $this->villeMagasin = $villeMagasin;
    }

    /**
     * @return int
     */
    public function getCodePostaleMagasin()
    {
        return $this->codePostaleMagasin;
    }

    /**
     * @param int $codePostaleMagasin
     */
    public function setCodePostaleMagasin($codePostaleMagasin)
    {
        $this->codePostaleMagasin = $codePostaleMagasin;
    }

    /**
     * @return string
     */
    public function getPhotoMagasin()
    {
        return $this->photoMagasin;
    }

    /**
     * @param string $photoMagasin
     */
    public function setPhotoMagasin($photoMagasin)
    {
        $this->photoMagasin = $photoMagasin;
    }

    /**
     * @return mixed
     */
    public function getBestSellerMagasin()
    {
        return $this->bestSellerMagasin;
    }

    /**
     * @param mixed $bestSellerMagasin
     */
    public function setBestSellerMagasin($bestSellerMagasin)
    {
        $this->bestSellerMagasin = $bestSellerMagasin;
    }




}
