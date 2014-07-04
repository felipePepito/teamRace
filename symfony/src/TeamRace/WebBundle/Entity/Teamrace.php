<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Teamraces
 */
class Teamrace
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
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
     * @var integer
     */
    private $idTeamrace;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idCreator;


    public function __construct(\TeamRace\WebBundle\Entity\User $user) {
    	$this->idCreator = $user;
    	$this->datecreated = new \DateTime();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Teamraces
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
     * @return Teamraces
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
     * @return Teamraces
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
     * @return Teamraces
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
     * Get idTeamrace
     *
     * @return integer 
     */
    public function getIdTeamrace()
    {
        return $this->idTeamrace;
    }

    /**
     * Set idCreator
     *
     * @param \TeamRace\WebBundle\Entity\User $idCreator
     * @return Teamraces
     */
    public function setIdCreator(\TeamRace\WebBundle\Entity\User $idCreator = null)
    {
        $this->idCreator = $idCreator;

        return $this;
    }

    /**
     * Get idCreator
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getIdCreator()
    {
        return $this->idCreator;
    }
}
