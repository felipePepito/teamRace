<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTeamrace
 *
 * @ORM\Table(name="user_teamrace", indexes={@ORM\Index(name="teamrace", columns={"teamrace"}), @ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity
 */
class UserTeamrace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_teamrace", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserTeamrace;

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
     * @var \Teamrace
     *
     * @ORM\ManyToOne(targetEntity="Teamrace")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teamrace", referencedColumnName="id_teamrace")
     * })
     */
    private $teamrace;



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
     * Set user
     *
     * @param \TeamRace\WebBundle\Entity\User $user
     * @return UserTeamrace
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
     * Set teamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamrace $teamrace
     * @return UserTeamrace
     */
    public function setTeamrace(\TeamRace\WebBundle\Entity\Teamrace $teamrace = null)
    {
        $this->teamrace = $teamrace;

        return $this;
    }

    /**
     * Get teamrace
     *
     * @return \TeamRace\WebBundle\Entity\Teamrace 
     */
    public function getTeamrace()
    {
        return $this->teamrace;
    }
}
