<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTeam
 */
class UserTeam
{
    /**
     * @var integer
     */
    private $role;

    /**
     * @var integer
     */
    private $idUserTeam;

    /**
     * @var \TeamRace\WebBundle\Entity\Teams
     */
    private $idTeam;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idUser;


    /**
     * Set role
     *
     * @param integer $role
     * @return UserTeam
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get idUserTeam
     *
     * @return integer 
     */
    public function getIdUserTeam()
    {
        return $this->idUserTeam;
    }

    /**
     * Set idTeam
     *
     * @param \TeamRace\WebBundle\Entity\Teams $idTeam
     * @return UserTeam
     */
    public function setIdTeam(\TeamRace\WebBundle\Entity\Teams $idTeam = null)
    {
        $this->idTeam = $idTeam;

        return $this;
    }

    /**
     * Get idTeam
     *
     * @return \TeamRace\WebBundle\Entity\Teams 
     */
    public function getIdTeam()
    {
        return $this->idTeam;
    }

    /**
     * Set idUser
     *
     * @param \TeamRace\WebBundle\Entity\User $idUser
     * @return UserTeam
     */
    public function setIdUser(\TeamRace\WebBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
