<?php

namespace MagasinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="Produit")
 * @ORM\Entity(repositoryClass="MagasinBundle\Repository\produitRepository")
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=200, nullable=false)
     */
    private $libelle;
    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="photoProduit", type="string", nullable=false)
     */
    private $photoProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="marque", type="string", nullable=false)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Magasin")
     * @ORM\JoinColumn(name="idMagasin", referencedColumnName="idMagasin")
     */
    private $idMagasin;

    /**
     * @var float
     *
     * @ORM\Column(name="nbFoisVendu", type="integer", nullable=true)
     */
    private $nbFoisVendu;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=600, nullable=true)
     */

    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", nullable=false)
     */
    private $prix;

    /**
     * @return int
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param int $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getPhotoProduit()
    {
        return $this->photoProduit;
    }

    /**
     * @param string $photoProduit
     */
    public function setPhotoProduit($photoProduit)
    {
        $this->photoProduit = $photoProduit;
    }

    /**
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getIdMagasin()
    {
        return $this->idMagasin;
    }

    /**
     * @param mixed $idMagasin
     */
    public function setIdMagasin($idMagasin)
    {
        $this->idMagasin = $idMagasin;
    }

    /**
     * @return float
     */
    public function getNbFoisVendu()
    {
        return $this->nbFoisVendu;
    }

    /**
     * @param float $nbFoisVendu
     */
    public function setNbFoisVendu($nbFoisVendu)
    {
        $this->nbFoisVendu = $nbFoisVendu;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
