<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blog
 *
 * @ORM\Table(name="blog", indexes={@ORM\Index(name="teamrace", columns={"teamrace"})})
 * @ORM\Entity
 */
class Blog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_blog", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBlog;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255, nullable=false)
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    private $text;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

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
     * Get idBlog
     *
     * @return integer 
     */
    public function getIdBlog()
    {
        return $this->idBlog;
    }

    /**
     * Set headline
     *
     * @param string $headline
     * @return Blog
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
     * @return Blog
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
     * Set teamrace
     *
     * @param \TeamRace\WebBundle\Entity\Teamrace $teamrace
     * @return Blog
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
