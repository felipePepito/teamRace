<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teamrace_backup
 */
class Teamrace_backup
{
    /**
     * @var integer
     */
    private $idTeamrace;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $creator;


    /**
     * Get idTeamrace
     *
     * @return integer 
     */
    public function getIdTeamrace()
    {
        return $this->idTeamrace;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Teamrace_backup
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
     * @return Teamrace_backup
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
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return Teamrace_backup
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime 
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Teamrace_backup
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
     * Set creator
     *
     * @param \TeamRace\WebBundle\Entity\User $creator
     * @return Teamrace_backup
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
}
