<?php
/**
 * Created by PhpStorm.
 * User: PC09
 * Date: 2/18/2018
 * Time: 9:20 AM
 */

namespace VeterinaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class HWCalculator
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_animal", type="string", length=200, nullable=false)
     */
    private $nom_animal;

    /**
     * @return string
     */
    public function getNomAnimal()
    {
        return $this->nom_animal;
    }

    /**
     * @param string $nom_animal
     */
    public function setNomAnimal($nom_animal)
    {
        $this->nom_animal = $nom_animal;
    }

    private $poid_animal;

    /**
     * @return decimal
     */
    public function getPoidAnimal()
    {
        return $this->poid_animal;
    }

    /**
     * @param decimal $poid_animal
     */
    public function setPoidAnimal($poid_animal)
    {
        $this->poid_animal = $poid_animal;
    }

    private $type_animal;
    /**
     * @return int
     */
    public function getTypeAnimal()
    {
        return $this->type_animal;
    }
    /**
     * @param int $type_animal
     */
    public function setTypeAnimal($type_animal)
    {
        $this->type_animal = $type_animal;
    }
    private $niveau_activite;
    /**
     * @return int
     */
    public function getNiveauActivite()
    {
        return $this->niveau_activite;
    }
    /**
     * @param int $niveau_activite
     */
    public function setNiveauActivite($niveau_activite)
    {
        $this->niveau_activite = $niveau_activite;
    }

    private $neutered;
    /**
     * @return int
     */
    public function getNeutered()
    {
        return $this->neutered;
    }
    /**
     * @param int $niveau_activite
     */
    public function setNeutered($neutered)
    {
        $this->neutered = $neutered;
    }
}