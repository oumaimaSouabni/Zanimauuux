<?php

namespace MagasinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="Panier")
 * @ORM\Entity(repositoryClass="MagasinBundle\Repository\panierRepository")
 */
class Panier
{

    /**
     * @ORM\ManyToOne(targetEntity="ZanimauxBundle\Entity\User")
     * @ORM\Id
     * @ORM\JoinColumn(name="cin", referencedColumnName="cin")
     */
    private $cin;

    /**
     * @var float
     *
     * @ORM\Column(name="somme", type="float", nullable=true)
     */
    private $somme;


    /**
     * @var float
     *
     * @ORM\Column(name="sommeCommande", type="float", nullable=true)
     */
    private $sommeCommande;
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
     * @return float
     */
    public function getSomme()
    {
        return $this->somme;
    }

    /**
     * @param float $somme
     */
    public function setSomme($somme)
    {
        $this->somme = $somme;
    }

    /**
     * @return float
     */
    public function getSommeCommande()
    {
        return $this->sommeCommande;
    }

    /**
     * @param float $sommeCommande
     */
    public function setSommeCommande($sommeCommande)
    {
        $this->sommeCommande = $sommeCommande;
    }

}
