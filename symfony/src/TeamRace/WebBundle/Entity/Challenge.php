<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Challenges
 */
class Challenge
{
    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $idChallenge;


    /**
     * Set type
     *
     * @param integer $type
     * @return Challenges
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
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
}
