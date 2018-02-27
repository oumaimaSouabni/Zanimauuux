<?php

namespace RefugeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Animal
*
 * @ORM\Table(name="animal")
* @ORM\Entity(repositoryClass="RefugeBundle\Repository\AnimalRepository")
*/
class Animal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAnimal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanimal;


    /**
     * @ORM\ManyToOne(targetEntity="RefugeBundle\Entity\Refuge" )
     * @ORM\JoinColumn(name="refuge", referencedColumnName="immatriculation")
     */
    private $refuge;

    /**
     * @return mixed
     */
    public function getRefuge()
    {
        return $this->refuge;
    }

    /**
     * @param mixed $refuge
     */
    public function setRefuge($refuge)
    {
        $this->refuge = $refuge;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=false)
     */
    private $etat;

    /**
     * @return int
     */
    public function getIdanimal()
    {
        return $this->idanimal;
    }

    /**
     * @param int $idanimal
     */
    public function setIdanimal($idanimal)
    {
        $this->idanimal = $idanimal;
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
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @param string $nomanimal
     */
    public function setNomanimal($nomanimal)
    {
        $this->nomanimal = $nomanimal;
    }

    /**
     * @return string
     */
    public function getNomanimal()
    {
        return $this->nomanimal;
    }

    /**
     * @return string
     */
    public function getPhotoanimal()
    {
        return $this->photoanimal;
    }

    /**
     * @param string $photoanimal
     */
    public function setPhotoanimal($photoanimal)
    {
        $this->photoanimal = $photoanimal;
    }





    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param string $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nomAnimal", type="string", length=255, nullable=false)
     */
    private $nomanimal;


    /**
     * @var string
     *
     * @ORM\Column(name="photoanimal", type="string", length=200, nullable=false)
     */

    private $photoanimal;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=200, nullable=false)
     */
    private $race;


}

