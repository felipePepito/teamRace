<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Challenge
 *
 * @ORM\Table(name="challenge_type")
 * @ORM\Entity
 */
class ChallengeType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_challenge_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChallengeType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;


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
     * Set description
     *
     * @param string $description
     * @return Challenge
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
     * Set creator
     *
     * @param \TeamRace\WebBundle\Entity\User $creator
     * @return Challenge
     */
    public function setCreator(\TeamRace\WebBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Get idChallengeType
     *
     * @return integer 
     */
    public function getIdChallengeType()
    {
        return $this->idChallengeType;
    }
}
