<?php

namespace PetSitterDresseurBundle\Entity;

use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promenade
 *
 * @ORM\Table(name="promenade")
 * @ORM\Entity(repositoryClass="PetSitterDresseurBundle\Repository\PromenadeRepository")
 */
class Promenade
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
     * @ORM\Column(name="nompromenade", type="string", length=20, nullable=true)
     */
    private $nomPromenade;

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cinPetsitter",referencedColumnName="cin")
     */
    private $cinPetsitter;

    /**
     * @var string
     *
     * @ORM\Column(name="typePromenade", type="string", nullable=true)
     */
    private $typePromenade;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuPromenade", type="string", length=20, nullable=true)
     */
    private $lieuPromenade;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionPromenade", type="string", length=20, nullable=true)
     */
    private $descriptionPromenade;

    /**
     * @var DateType
     *
     * @ORM\Column(name="datedebutPromenade", type="string", length=20, nullable=true)
     */
    private $datedebutPromenade;

    /**
     * @var DateType
     *
     * @ORM\Column(name="datefinPromenade", type="string", length=20, nullable=true)
     */
    private $datefinPromenade;


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
     * Set nomPromenade
     *
     * @param string $nomPromenade
     *
     * @return Promenade
     */
    public function setNomPromenade($nomPromenade)
    {
        $this->nomPromenade = $nomPromenade;

        return $this;
    }

    /**
     * Get nomPromenade
     *
     * @return string
     */
    public function getNomPromenade()
    {
        return $this->nomPromenade;
    }

    /**
     * Set typePromenade
     *
     * @param string $typePromenade
     *
     * @return Promenade
     */
    public function setTypePromenade($typePromenade)
    {
        $this->typePromenade = $typePromenade;

        return $this;
    }

    /**
     * Get typePromenade
     *
     * @return string
     */
    public function getTypePromenade()
    {
        return $this->typePromenade;
    }


    /**
     * Set lieuPromenade
     *
     * @param string $lieuPromenade
     *
     * @return Promenade
     */
    public function setLieuPromenade($lieuPromenade)
    {
        $this->lieuPromenade = $lieuPromenade;

        return $this;
    }

    /**
     * Get lieuPromenade
     *
     * @return string
     */
    public function getLieuPromenade()
    {
        return $this->lieuPromenade;
    }

    /**
     * Set descriptionPromenade
     *
     * @param string $descriptionPromenade
     *
     * @return Promenade
     */
    public function setDescriptionPromenade($descriptionPromenade)
    {
        $this->descriptionPromenade = $descriptionPromenade;

        return $this;
    }

    /**
     * Get descriptionPromenade
     *
     * @return string
     */
    public function getDescriptionPromenade()
    {
        return $this->descriptionPromenade;
    }

    /**
     * Set datedebutPromenade
     *
     * @param string $datedebutPromenade
     *
     * @return Promenade
     */
    public function setDatedebutPromenade($datedebutPromenade)
    {
        $this->datedebutPromenade = $datedebutPromenade;

        return $this;
    }

    /**
     * Get datedebutPromenade
     *
     * @return string
     */
    public function getDatedebutPromenade()
    {
        return $this->datedebutPromenade;
    }

    /**
     * Set datefinPromenade
     *
     * @param string $datefinPromenade
     *
     * @return Promenade
     */
    public function setDatefinPromenade($datefinPromenade)
    {
        $this->datefinPromenade = $datefinPromenade;

        return $this;
    }

    /**
     * Get datefinPromenade
     *
     * @return string
     */
    public function getDatefinPromenade()
    {
        return $this->datefinPromenade;
    }


    /**
     * Set cinPetsitter
     *
     * @param \ZanimauxBundle\Entity\User $cinPetsitter
     *
     * @return Promenade
     */
    public function setCinPetsitter(\ZanimauxBundle\Entity\User $cinPetsitter = null)
    {
        $this->cinPetsitter = $cinPetsitter;

        return $this;
    }

    /**
     * Get cinPetsitter
     *
     * @return \ZanimauxBundle\Entity\User
     */
    public function getCinPetsitter()
    {
        return $this->cinPetsitter;
    }
}
