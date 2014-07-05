<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Teamrace
 *
 * @ORM\Table(name="teamrace", indexes={@ORM\Index(name="creator", columns={"creator"})})
 * @ORM\Entity
 */
class Teamrace_backup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_teamrace", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTeamrace;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime", nullable=false)
     */
    private $datecreated;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="creator", referencedColumnName="id_user")
     * })
     */
    private $creator;


    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idCreator;


    /**
     * Set name
     *
     * @param string $name
     * @return Teamrace
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
     * @return Teamrace
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
     * @return Teamrace
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
     * @return Teamrace
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
     * @return Teamrace
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
