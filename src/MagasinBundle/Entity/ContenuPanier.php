<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 10/02/2018
 * Time: 5:12 PM
 */

namespace MagasinBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * ContenuPanier
 *
 * @ORM\Table(name="ContenuPanier")
 * @ORM\Entity(repositoryClass="MagasinBundle\Repository\contenuPanierRepository")
 */

class ContenuPanier
{

    /**
     * @var integer
     *
     * @ORM\Column(name="idContenuPanier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContenuPanier;
    /**
     * @ORM\ManyToOne(targetEntity="Panier",cascade={"persist"})
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;

    /**
     * @ORM\ManyToOne(targetEntity="Produit",cascade={"persist"})
     * @ORM\JoinColumn(name="idProduit", referencedColumnName="idProduit")
     */
    private $idProduit;
    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var commande
     * @ORM\Column(name="commande", type="boolean", nullable=true)
     */
    private $commande;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateCommande", type="date", nullable=true)
     */
    private $dateCommande;
    /**
     * @return mixed
     */
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
    public function getIdContenuPanier()
    {
        return $this->idContenuPanier;
    }

    /**
     * @param mixed $idContenuPanier
     */
    public function setIdContenuPanier($idContenuPanier)
    {
        $this->idContenuPanier = $idContenuPanier;
    }


    /**
     * @param mixed $idPanier
     */
    public function setIdPanier($idPanier)
    {
        $this->idPanier = $idPanier;
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param mixed $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
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
     * Set commande
     *
     * @param boolean $commande
     *
     * @return ContenuPanier
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return boolean
     */
    public function getCommande()
    {
        return $this->commande;
    }



    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return ContenuPanier
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }
}
