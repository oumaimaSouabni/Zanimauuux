<?php

namespace VeterinaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;
use ZanimauxBundle\Entity\User;


/**
 * Article
 *
 * @ORM\Entity(repositoryClass="VeterinaireBundle\Repository\ArticleRepository")
 * @ORM\Table(name="Article")
 * @Notifiable(name="Article")
 */
class Article implements NotifiableInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=200, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=6000, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="piecejointe", type="string", length=6000, nullable=false)
     */
    private $piecejointe;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPiecejointe()
    {
        return $this->piecejointe;
    }

    /**
     * @param string $piecejointe
     */
    public function setPiecejointe($piecejointe)
    {
        $this->piecejointe = $piecejointe;
    }




}
