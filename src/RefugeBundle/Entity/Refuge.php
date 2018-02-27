<?php

namespace RefugeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Animal
 *
 * @ORM\Table(name="Refuge")
 * @ORM\Entity(repositoryClass="RefugeBundle\Repository\RefugeRepository")
 */
class Refuge
{
    /**
     * @ORM\Id
     * @ORM\Column(name="immatriculation",type="string",length=255)
     *
     */
    private $immatriculation;

    /**
     * @return string
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * @param string $immatriculation
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;
    }

    /**
     * @return string
     */
    public function getNomrefuge()
    {
        return $this->nomrefuge;
    }

    /**
     * @param string $nomrefuge
     */
    public function setNomrefuge($nomrefuge)
    {
        $this->nomrefuge = $nomrefuge;
    }

    /**
     * @return string
     */
    public function getEmailrefuge()
    {
        return $this->emailrefuge;
    }

    /**
     * @param string $emailrefuge
     */
    public function setEmailrefuge($emailrefuge)
    {
        $this->emailrefuge = $emailrefuge;
    }

    /**
     * @return int
     */
    public function getTelephonerefuge()
    {
        return $this->telephonerefuge;
    }

    /**
     * @param int $telephonerefuge
     */
    public function setTelephonerefuge($telephonerefuge)
    {
        $this->telephonerefuge = $telephonerefuge;
    }

    /**
     * @return int
     */
    public function getFaxrefuge()
    {
        return $this->faxrefuge;
    }

    /**
     * @param int $faxrefuge
     */
    public function setFaxrefuge($faxrefuge)
    {
        $this->faxrefuge = $faxrefuge;
    }

    /**
     * @return string
     */
    public function getAdresserefuge()
    {
        return $this->adresserefuge;
    }

    /**
     * @param string $adresserefuge
     */
    public function setAdresserefuge($adresserefuge)
    {
        $this->adresserefuge = $adresserefuge;
    }

    /**
     * @return int
     */
    public function getCodepostalerefuge()
    {
        return $this->codepostalerefuge;
    }

    /**
     * @param int $codepostalerefuge
     */
    public function setCodepostalerefuge($codepostalerefuge)
    {
        $this->codepostalerefuge = $codepostalerefuge;
    }

    /**
     * @return string
     */
    public function getGouvernementrefuge()
    {
        return $this->gouvernementrefuge;
    }

    /**
     * @param string $gouvernementrefuge
     */
    public function setGouvernementrefuge($gouvernementrefuge)
    {
        $this->gouvernementrefuge = $gouvernementrefuge;
    }

    /**
     * @return string
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param string $chat
     */
    public function setChat($chat)
    {
        $this->chat = $chat;
    }

    /**
     * @return string
     */
    public function getChien()
    {
        return $this->chien;
    }

    /**
     * @param string $chien
     */
    public function setChien($chien)
    {
        $this->chien = $chien;
    }

    /**
     * @return string
     */
    public function getRongeur()
    {
        return $this->rongeur;
    }

    /**
     * @param string $rongeur
     */
    public function setRongeur($rongeur)
    {
        $this->rongeur = $rongeur;
    }




    /**
     * @return string
     */
    public function getAutre()
    {
        return $this->autre;
    }

    /**
     * @param string $autre
     */
    public function setAutre($autre)
    {
        $this->autre = $autre;
    }

    /**
     * @return mixed
     */
    public function getCin()
    {
        return $this->cin;
    }


    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User" )
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;
    /**
     * @var string
     *
     * @ORM\Column(name="nomRefuge", type="string", length=20, nullable=false)
     */
    private $nomrefuge;

    /**
     * @var string
     *
     * @ORM\Column(name="emailRefuge", type="string", length=200, nullable=false)
     */
    private $emailrefuge;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephoneRefuge", type="integer", nullable=false)
     */
    private $telephonerefuge;

    /**
     * @var integer
     *
     * @ORM\Column(name="faxRefuge", type="integer", nullable=false)
     */
    private $faxrefuge;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseRefuge", type="string", length=200, nullable=false)
     */
    private $adresserefuge;

    /**
     * @var integer
     *
     * @ORM\Column(name="codePostaleRefuge", type="integer", nullable=false)
     */
    private $codepostalerefuge;

    /**
     * @var string
     *
     * @ORM\Column(name="gouvernementrefuge", type="string", length=20, nullable=false)
     */
    private $gouvernementrefuge;

    /**
     * @param mixed $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="photorefuge", type="string", length=20, nullable=false)
     */
    private $photorefuge;

    /**
     * @return string
     */
    public function getPhotorefuge()
    {
        return $this->photorefuge;
    }

    /**
     * @param string $photorefuge
     */
    public function setPhotorefuge($photorefuge)
    {
        $this->photorefuge = $photorefuge;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="chat", type="string", length=20, nullable=true)
     */
    private $chat;

    /**
     * @var string
     *
     * @ORM\Column(name="chien", type="string", length=20, nullable=true)
     */
    private $chien;
    /**
     * @var string
     *
     * @ORM\Column(name="rongeur", type="string", length=20, nullable=true)
     */
    private $rongeur;

    /**
     * @var string
     *
     * @ORM\Column(name="autre", type="string", length=20, nullable=true)
     */
    private $autre;


}

