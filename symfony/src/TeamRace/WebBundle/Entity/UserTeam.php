<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTeam
 *
 * @ORM\Table(name="user_team", indexes={@ORM\Index(name="team", columns={"team"}), @ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity
 */
class UserTeam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_team", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserTeam;

    /**
     * @var integer
     *
     * @ORM\Column(name="role", type="integer", nullable=false)
     */
    private $role;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id_user")
     * })
     */
    private $user;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team", referencedColumnName="id_team")
     * })
     */
    private $team;



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
     * Set user
     *
     * @param \TeamRace\WebBundle\Entity\User $user
     * @return UserTeam
     */
    public function setUser(\TeamRace\WebBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set team
     *
     * @param \TeamRace\WebBundle\Entity\Team $team
     * @return UserTeam
     */
    public function setTeam(\TeamRace\WebBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \TeamRace\WebBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
