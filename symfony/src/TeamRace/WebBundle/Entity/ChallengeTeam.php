<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChallengeTeam
 */
class ChallengeTeam
{
    /**
     * @var float
     */
    private $points;

    /**
     * @var integer
     */
    private $idChallengeTeam;

    /**
     * @var \TeamRace\WebBundle\Entity\Teams
     */
    private $idTeam;

    /**
     * @var \TeamRace\WebBundle\Entity\Challenges
     */
    private $idChallenge;


    /**
     * Set points
     *
     * @param float $points
     * @return ChallengeTeam
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return float 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Get idChallengeTeam
     *
     * @return integer 
     */
    public function getIdChallengeTeam()
    {
        return $this->idChallengeTeam;
    }

    /**
     * Set idTeam
     *
     * @param \TeamRace\WebBundle\Entity\Teams $idTeam
     * @return ChallengeTeam
     */
    public function setIdTeam(\TeamRace\WebBundle\Entity\Teams $idTeam = null)
    {
        $this->idTeam = $idTeam;

        return $this;
    }

    /**
     * Get idTeam
     *
     * @return \TeamRace\WebBundle\Entity\Teams 
     */
    public function getIdTeam()
    {
        return $this->idTeam;
    }

    /**
     * Set idChallenge
     *
     * @param \TeamRace\WebBundle\Entity\Challenges $idChallenge
     * @return ChallengeTeam
     */
    public function setIdChallenge(\TeamRace\WebBundle\Entity\Challenges $idChallenge = null)
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
}
