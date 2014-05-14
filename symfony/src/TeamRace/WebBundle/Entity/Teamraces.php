<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teamraces
 */
class Teamraces
{
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
     * @var integer
     */
    private $idTeamrace;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idCreator;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add idUser
     *
     * @param \TeamRace\WebBundle\Entity\User $idUser
     * @return Teamraces
     */
    public function addIdUser(\TeamRace\WebBundle\Entity\User $idUser)
    {
        $this->idUser[] = $idUser;

        return $this;
    }

    /**
     * Remove idUser
     *
     * @param \TeamRace\WebBundle\Entity\User $idUser
     */
    public function removeIdUser(\TeamRace\WebBundle\Entity\User $idUser)
    {
        $this->idUser->removeElement($idUser);
    }

    /**
     * Get idUser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
