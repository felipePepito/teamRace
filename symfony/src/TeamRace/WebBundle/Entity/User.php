<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $pw;

    /**
     * @var string
     */
    private $pwSalt;

    /**
     * @var integer
     */
    private $active;

    /**
     * @var \DateTime
     */
    private $accountCreated;

    /**
     * @var \DateTime
     */
    private $firstLogin;

    /**
     * @var \DateTime
     */
    private $lastLogin;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idTeamrace;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTeamrace = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set pw
     *
     * @param string $pw
     * @return User
     */
    public function setPw($pw)
    {
        $this->pw = $pw;

        return $this;
    }

    /**
     * Get pw
     *
     * @return string 
     */
    public function getPw()
    {
        return $this->pw;
    }

    /**
     * Set pwSalt
     *
     * @param string $pwSalt
     * @return User
     */
    public function setPwSalt($pwSalt)
    {
        $this->pwSalt = $pwSalt;

        return $this;
    }

    /**
     * Get pwSalt
     *
     * @return string 
     */
    public function getPwSalt()
    {
        return $this->pwSalt;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set accountCreated
     *
     * @param \DateTime $accountCreated
     * @return User
     */
    public function setAccountCreated($accountCreated)
    {
        $this->accountCreated = $accountCreated;

        return $this;
    }

    /**
     * Get accountCreated
     *
     * @return \DateTime 
     */
    public function getAccountCreated()
    {
        return $this->accountCreated;
    }

    /**
     * Set firstLogin
     *
     * @param \DateTime $firstLogin
     * @return User
     */
    public function setFirstLogin($firstLogin)
    {
        $this->firstLogin = $firstLogin;

        return $this;
    }

    /**
     * Get firstLogin
     *
     * @return \DateTime 
     */
    public function getFirstLogin()
    {
        return $this->firstLogin;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return User
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
     * Set description
     *
     * @param string $description
     * @return User
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
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Add idTeamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamraces $idTeamrace
     * @return User
     */
    public function addIdTeamrace(\TeamRace\WebBundle\Entity\Teamraces $idTeamrace)
    {
        $this->idTeamrace[] = $idTeamrace;

        return $this;
    }

    /**
     * Remove idTeamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamraces $idTeamrace
     */
    public function removeIdTeamrace(\TeamRace\WebBundle\Entity\Teamraces $idTeamrace)
    {
        $this->idTeamrace->removeElement($idTeamrace);
    }

    /**
     * Get idTeamrace
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdTeamrace()
    {
        return $this->idTeamrace;
    }
    
    


    // *******************************************************
    // ***** Implementation of the AdvancedUserInterface *****
    // *******************************************************
    
    
    /**
     * @inheritDoc
     */
    public function isAccountNonExpired()
    {
    	return true;
    }
    
    /**
     * @inheritDoc
     */
    public function isAccountNonLocked()
    {
    	return true;
    }
    
    /**
     * @inheritDoc
     */
    public function isCredentialsNonExpired()
    {
    	return true;
    }
    
    /**
     * @inheritDoc
     */
    public function isEnabled()
    {
    	return $this->getActive();
    }
    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
    	return $this->email;
    }
    
    /**
     * @inheritDoc
     */
    public function getSalt()
    {
    	return "";
    	//return $this->pwSalt;
    }
    
    /**
     * @inheritDoc
     */
    public function getPassword()
    {
    	return $this->pw;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
    	return array('ROLE_USER');
    }
    
    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
    	return serialize(array(
    			$this->idUser,
    			$this->email,
    			$this->pw,
    			$this->active,
    			// see section on salt below
    			// $this->salt,
    	));
    }
    
    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
    	list (
    			$this->idUser,
    			$this->email,
    			$this->pw,
    			$this->active,
    			// see section on salt below
    			// $this->salt
    	) = unserialize($serialized);
    }
    
}
