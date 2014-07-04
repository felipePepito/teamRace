<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blogs
 */
class Blog
{
    /**
     * @var string
     */
    private $headline;

    /**
     * @var string
     */
    private $text;

    /**
     * @var integer
     */
    private $idBlog;

    /**
     * @var \TeamRace\WebBundle\Entity\Teamraces
     */
    private $idTeamrace;


    /**
     * Set headline
     *
     * @param string $headline
     * @return Blogs
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Blogs
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get idBlog
     *
     * @return integer 
     */
    public function getIdBlog()
    {
        return $this->idBlog;
    }

    /**
     * Set idTeamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamraces $idTeamrace
     * @return Blogs
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
