<?php

namespace VeterinaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZanimauxBundle\Entity\User;

/**
 * Cabinet
 *
 * @ORM\Table(name="cabinet")
 * @ORM\Entity(repositoryClass="VeterinaireBundle\Repository\CabinetRepository")
 */
class Cabinet
{
    /**
     * @ORM\Id
     * @ORM\Column(name="immatriculecabinet", type="string", length=20)
     *
     */
    private $immatriculecabinet;

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
     * @ORM\OneToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCabinet", type="string", length=200, nullable=false)
     */
    private $emailcabinet;

    /**
     * @var string
     *
     * @ORM\Column(name="photovet", type="string", length=200, nullable=false)
     */
    private $photovet;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephoneCabinet", type="integer", nullable=false)
     */
    private $telephonecabinet;

    /**
     * @var integer
     *
     * @ORM\Column(name="faxCabinet", type="integer", nullable=false)
     */
    private $faxcabinet;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseCabinet", type="string", length=200, nullable=false)
     */
    private $adressecabinet;
    /**
     * @var string
     *
     * @ORM\Column(name="villeCabinet", type="string", length=200, nullable=false)
     */
    private $villecabinet;

    /**
     * @return string
     */
    public function getVillecabinet()
    {
        return $this->villecabinet;
    }

    /**
     * @param string $villecabinet
     */
    public function setVillecabinet($villecabinet)
    {
        $this->villecabinet = $villecabinet;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="codePostaleCabinet", type="integer", nullable=false)
     */
    private $codepostalecabinet;

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
     * @return string
     */
    public function getPhotovet()
    {
        return $this->photovet;
    }

    /**
     * @param string $photovet
     */
    public function setPhotovet($photovet)
    {
        $this->photovet = $photovet;
    }

    /**
     * Set emailcabinet
     *
     * @param string $emailcabinet
     *
     * @return Cabinet
     */
    public function setEmailcabinet($emailcabinet )
    {
        $this->emailcabinet = $emailcabinet;

        return $this;
    }

    /**
     * Get emailcabinet
     *
     * @return string
     */
    public function getEmailcabinet()
    {
        return $this->emailcabinet;
    }

    /**
     * Set telephonecabinet
     *
     * @param integer $telephonecabinet
     *
     * @return Cabinet
     */
    public function setTelephonecabinet($telephonecabinet)
    {
        $this->telephonecabinet = $telephonecabinet;

        return $this;
    }

    /**
     * Get telephonecabinet
     *
     * @return integer
     */
    public function getTelephonecabinet()
    {
        return $this->telephonecabinet;
    }

    /**
     * Set faxcabinet
     *
     * @param integer $faxcabinet
     *
     * @return Cabinet
     */
    public function setFaxcabinet($faxcabinet)
    {
        $this->faxcabinet = $faxcabinet;

        return $this;
    }

    /**
     * Get faxcabinet
     *
     * @return integer
     */
    public function getFaxcabinet()
    {
        return $this->faxcabinet;
    }

    /**
     * Set adressecabinet
     *
     * @param string $adressecabinet
     *
     * @return Cabinet
     */
    public function setAdressecabinet($adressecabinet)
    {
        $this->adressecabinet = $adressecabinet;

        return $this;
    }

    /**
     * Get adressecabinet
     *
     * @return string
     */
    public function getAdressecabinet()
    {
        return $this->adressecabinet;
    }

    /**
     * Set codepostalecabinet
     *
     * @param integer $codepostalecabinet
     *
     * @return Cabinet
     */
    public function setCodepostalecabinet($codepostalecabinet)
    {
        $this->codepostalecabinet = $codepostalecabinet;

        return $this;
    }

    /**
     * Get codepostalecabinet
     *
     * @return integer
     */
    public function getCodepostalecabinet()
    {
        return $this->codepostalecabinet;
    }






}
