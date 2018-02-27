<?php

namespace RefugeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionnaireChat
 *
 * @ORM\Table(name="questionnaire_chat")
 * @ORM\Entity(repositoryClass="RefugeBundle\Repository\QuestionnaireChatRepository")
 */
class QuestionnaireChat
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
     * @ORM\Column(name="dynamique", type="string", length=255)
     */
    private $dynamique;

    /**
     * @var string
     *
     * @ORM\Column(name="affectueux", type="string", length=255)
     */
    private $affectueux;

    /**
     * @var string
     *
     * @ORM\Column(name="chutePoils", type="string", length=255)
     */
    private $chutePoils;

    /**
     * @var string
     *
     * @ORM\Column(name="intelligent", type="string", length=255)
     */
    private $intelligent;

    /**
     * @var string
     *
     * @ORM\Column(name="acceptationEtranger", type="string", length=255)
     */
    private $acceptationEtranger;

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
     * @return QuestionnaireChat
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
     * Set dnamique
     *
     * @param string $dynamique
     *
     * @return QuestionnaireChat
     */
    public function setDnamique($dynamique)
    {
        $this->dynamique = $dynamique;

        return $this;
    }

    /**
     * Get dnamique
     *
     * @return string
     */
    public function getDynamique()
    {
        return $this->dynamique;
    }

    /**
     * Set affectueux
     *
     * @param string $affectueux
     *
     * @return QuestionnaireChat
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
     * Set chutePoils
     *
     * @param string $chutePoils
     *
     * @return QuestionnaireChat
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

    /**
     * Set intelligent
     *
     * @param string $intelligent
     *
     * @return QuestionnaireChat
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
     * Set acceptationEtranger
     *
     * @param string $acceptationEtranger
     *
     * @return QuestionnaireChat
     */
    public function setAcceptationEtranger($acceptationEtranger)
    {
        $this->acceptationEtranger = $acceptationEtranger;

        return $this;
    }

    /**
     * Get acceptationEtranger
     *
     * @return string
     */
    public function getAcceptationEtranger()
    {
        return $this->acceptationEtranger;
    }
}

