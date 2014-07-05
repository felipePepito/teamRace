<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChallengeTeam
 *
 * @ORM\Table(name="challenge_team", indexes={@ORM\Index(name="team", columns={"team"}), @ORM\Index(name="challenge", columns={"challenge"})})
 * @ORM\Entity
 */
class ChallengeTeam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_challenge_team", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChallengeTeam;

    /**
     * @var float
     *
     * @ORM\Column(name="points", type="float", precision=10, scale=0, nullable=true)
     */
    private $points;

    /**
     * @var \TeamraceChallenge
     *
     * @ORM\ManyToOne(targetEntity="TeamraceChallenge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="challenge", referencedColumnName="id_teamrace_challenge")
     * })
     */
    private $challenge;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team", referencedColumnName="id_team")
     * })
     */
    private $team;



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
     * Set challenge
     *
     * @param \TeamRace\WebBundle\Entity\TeamraceChallenge $challenge
     * @return ChallengeTeam
     */
    public function setChallenge(\TeamRace\WebBundle\Entity\TeamraceChallenge $challenge = null)
    {
        $this->challenge = $challenge;

        return $this;
    }

    /**
     * Get challenge
     *
     * @return \TeamRace\WebBundle\Entity\TeamraceChallenge 
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * Set team
     *
     * @param \TeamRace\WebBundle\Entity\Team $team
     * @return ChallengeTeam
     */
    public function setTeam(\TeamRace\WebBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \TeamRace\WebBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
