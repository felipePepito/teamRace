<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 */
class Teams
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $slogan;

    /**
     * @var integer
     */
    private $idTeam;

    /**
     * @var \TeamRace\WebBundle\Entity\Teamraces
     */
    private $idTeamrace;


    /**
     * Set name
     *
     * @param string $name
     * @return Teams
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
     * Set image
     *
     * @param string $image
     * @return Teams
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set slogan
     *
     * @param string $slogan
     * @return Teams
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get slogan
     *
     * @return string 
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Get idTeam
     *
     * @return integer 
     */
    public function getIdTeam()
    {
        return $this->idTeam;
    }

    /**
     * Set idTeamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamraces $idTeamrace
     * @return Teams
     */
    public function setIdTeamrace(\TeamRace\WebBundle\Entity\Teamraces $idTeamrace = null)
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
