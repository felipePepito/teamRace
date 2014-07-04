<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTeamrace
 */
class UserTeamrace
{
    /**
     * @var integer
     * Values:
     * 1 => Admin
     * 2 => Tutor
     * 3 => User
     */
    private $role;

    /**
     * @var integer
     */
    private $idUserTeamrace;

    /**
     * @var \TeamRace\WebBundle\Entity\Teamraces
     */
    private $idTeamrace;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idUser;


    /**
     * Set role
     *
     * @param integer $role
     * @return UserTeamrace
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
     * Get idUserTeamrace
     *
     * @return integer 
     */
    public function getIdUserTeamrace()
    {
        return $this->idUserTeamrace;
    }

    /**
     * Set idTeamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamraces $idTeamrace
     * @return UserTeamrace
     */
    public function setIdTeamrace(\TeamRace\WebBundle\Entity\Teamrace $idTeamrace = null)
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

    /**
     * Set idUser
     *
     * @param \TeamRace\WebBundle\Entity\User $idUser
     * @return UserTeamrace
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
