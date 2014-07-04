<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamraceChallenge
 */
class TeamraceChallenge
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var float
     */
    private $maxPoints;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $idTeamraceChallenge;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idTutor;

    /**
     * @var \TeamRace\WebBundle\Entity\Challenge
     */
    private $idChallenge;

    /**
     * @var \TeamRace\WebBundle\Entity\Teamrace
     */
    private $idTeamrace;


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return TeamraceChallenge
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set maxPoints
     *
     * @param float $maxPoints
     * @return TeamraceChallenge
     */
    public function setMaxPoints($maxPoints)
    {
        $this->maxPoints = $maxPoints;

        return $this;
    }

    /**
     * Get maxPoints
     *
     * @return float 
     */
    public function getMaxPoints()
    {
        return $this->maxPoints;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TeamraceChallenge
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

    /**
     * Get idTeamraceChallenge
     *
     * @return integer 
     */
    public function getIdTeamraceChallenge()
    {
        return $this->idTeamraceChallenge;
    }

    /**
     * Set idTutor
     *
     * @param \TeamRace\WebBundle\Entity\User $idTutor
     * @return TeamraceChallenge
     */
    public function setIdTutor(\TeamRace\WebBundle\Entity\User $idTutor = null)
    {
        $this->idTutor = $idTutor;

        return $this;
    }

    /**
     * Get idTutor
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getIdTutor()
    {
        return $this->idTutor;
    }

    /**
     * Set idChallenge
     *
     * @param \TeamRace\WebBundle\Entity\Challenges $idChallenge
     * @return TeamraceChallenge
     */
    public function setIdChallenge(\TeamRace\WebBundle\Entity\Challenge $idChallenge = null)
    {
        $this->idChallenge = $idChallenge;

        return $this;
    }

    /**
     * Get idChallenge
     *
     * @return \TeamRace\WebBundle\Entity\Challenges 
     */
    public function getIdChallenge()
    {
        return $this->idChallenge;
    }

    /**
     * Set idTeamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamraces $idTeamrace
     * @return TeamraceChallenge
     */
    public function setIdTeamrace(\TeamRace\WebBundle\Entity\Teamrace $idTeamrace = null)
    {
        $this->idTeamrace = $idTeamrace;

        return $this;
    }

    /**
     * Get idTeamrace
     *
     * @return \TeamRace\WebBundle\Entity\Teamraces 
     */
    public function getIdTeamrace()
    {
        return $this->idTeamrace;
    }
}
