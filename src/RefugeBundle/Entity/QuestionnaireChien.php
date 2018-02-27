<?php

namespace RefugeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionnaireChien
 *
 * @ORM\Table(name="questionnaire_chien")
 * @ORM\Entity(repositoryClass="RefugeBundle\Repository\QuestionnaireChienRepository")
 */
class QuestionnaireChien
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
     * @ORM\Column(name="tolererChien", type="string", length=255)
     */
    private $tolererChien;

    /**
     * @var string
     *
     * @ORM\Column(name="tolererChat", type="string", length=255)
     */
    private $tolererChat;

    /**
     * @var string
     *
     * @ORM\Column(name="affectueux", type="string", length=255)
     */
    private $affectueux;

    /**
     * @var string
     *
     * @ORM\Column(name="intelligent", type="string", length=255)
     */
    private $intelligent;

    /**
     * @var string
     *
     * @ORM\Column(name="chutePoils", type="string", length=255)
     */
    private $chutePoils;

    /**
     * @return string
     */
    public function getCalme()
    {
        return $this->calme;
    }

    /**
     * @param string $calme
     */
    public function setCalme($calme)
    {
        $this->calme = $calme;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="calme", type="string", length=255)
     */

    private $calme;

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }
    /**
     * @ORM\ManyToOne(targetEntity="RefugeBundle\Entity\Race" )
     * @ORM\JoinColumn(name="race", referencedColumnName="id")
     */
    private $race;


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
     * Set tolererChien
     *
     * @param string $tolererChien
     *
     * @return QuestionnaireChien
     */
    public function setTolererChien($tolererChien)
    {
        $this->tolererChien = $tolererChien;

        return $this;
    }

    /**
     * Get tolererChien
     *
     * @return string
     */
    public function getTolererChien()
    {
        return $this->tolererChien;
    }

    /**
     * Set tolererChat
     *
     * @param string $tolererChat
     *
     * @return QuestionnaireChien
     */
    public function setTolererChat($tolererChat)
    {
        $this->tolererChat = $tolererChat;

        return $this;
    }

    /**
     * Get tolererChat
     *
     * @return string
     */
    public function getTolererChat()
    {
        return $this->tolererChat;
    }

    /**
     * Set affectueux
     *
     * @param string $affectueux
     *
     * @return QuestionnaireChien
     */
    public function setAffectueux($affectueux)
    {
        $this->affectueux = $affectueux;

        return $this;
    }

    /**
     * Get affectueux
     *
     * @return string
     */
    public function getAffectueux()
    {
        return $this->affectueux;
    }

    /**
     * Set intelligent
     *
     * @param string $intelligent
     *
     * @return QuestionnaireChien
     */
    public function setIntelligent($intelligent)
    {
        $this->intelligent = $intelligent;

        return $this;
    }

    /**
     * Get intelligent
     *
     * @return string
     */
    public function getIntelligent()
    {
        return $this->intelligent;
    }

    /**
     * Set chutePoils
     *
     * @param string $chutePoils
     *
     * @return QuestionnaireChien
     */
    public function setChutePoils($chutePoils)
    {
        $this->chutePoils = $chutePoils;

        return $this;
    }

    /**
     * Get chutePoils
     *
     * @return string
     */
    public function getChutePoils()
    {
        return $this->chutePoils;
    }
}

