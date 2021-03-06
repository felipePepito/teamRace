<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamraceChallenge
 *
 * @ORM\Table(name="challenge", indexes={@ORM\Index(name="tutor", columns={"tutor"}), @ORM\Index(name="challengeType", columns={"challenge_type"}), @ORM\Index(name="teamrace", columns={"teamrace"})})
 * @ORM\Entity
 */
class Challenge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_challenge", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChallenge;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="max_points", type="float", precision=10, scale=0, nullable=true)
     */
    private $maxPoints;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Teamrace
     *
     * @ORM\ManyToOne(targetEntity="Teamrace")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teamrace", referencedColumnName="id_teamrace")
     * })
     */
    private $teamrace;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tutor", referencedColumnName="id_user")
     * })
     */
    private $tutor;

    /**
     * @var \ChallengeType
     *
     * @ORM\ManyToOne(targetEntity="ChallengeType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="challenge_type", referencedColumnName="id_challenge_type")
     * })
     */
    private $challengeType;



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
     * Set teamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamrace $teamrace
     * @return TeamraceChallenge
     */
    public function setTeamrace(\TeamRace\WebBundle\Entity\Teamrace $teamrace = null)
    {
        $this->teamrace = $teamrace;

        return $this;
    }

    /**
     * Get teamrace
     *
     * @return \TeamRace\WebBundle\Entity\Teamrace 
     */
    public function getTeamrace()
    {
        return $this->teamrace;
    }

    /**
     * Set tutor
     *
     * @param \TeamRace\WebBundle\Entity\User $tutor
     * @return TeamraceChallenge
     */
    public function setTutor(\TeamRace\WebBundle\Entity\User $tutor = null)
    {
        $this->tutor = $tutor;

        return $this;
    }

    /**
     * Get tutor
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * Set challenge
     *
     * @param \TeamRace\WebBundle\Entity\Challenge $challenge
     * @return TeamraceChallenge
     */
    public function setChallenge(\TeamRace\WebBundle\Entity\Challenge $challenge = null)
    {
        $this->challenge = $challenge;

        return $this;
    }

    /**
     * Get challenge
     *
     * @return \TeamRace\WebBundle\Entity\Challenge 
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * Get idChallenge
     *
     * @return integer 
     */
    public function getIdChallenge()
    {
        return $this->idChallenge;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Challenge
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set challengeType
     *
     * @param \TeamRace\WebBundle\Entity\ChallengeType $challengeType
     * @return Challenge
     */
    public function setChallengeType(\TeamRace\WebBundle\Entity\ChallengeType $challengeType = null)
    {
        $this->challengeType = $challengeType;

        return $this;
    }

    /**
     * Get challengeType
     *
     * @return \TeamRace\WebBundle\Entity\ChallengeType 
     */
    public function getChallengeType()
    {
        return $this->challengeType;
    }
}
