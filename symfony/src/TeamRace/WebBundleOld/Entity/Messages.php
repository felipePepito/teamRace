<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 */
class Messages
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $idMessage;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idRecipient;

    /**
     * @var \TeamRace\WebBundle\Entity\User
     */
    private $idSender;


    /**
     * Set text
     *
     * @param string $text
     * @return Messages
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
     * Set date
     *
     * @param \DateTime $date
     * @return Messages
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get idMessage
     *
     * @return integer 
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * Set idRecipient
     *
     * @param \TeamRace\WebBundle\Entity\User $idRecipient
     * @return Messages
     */
    public function setIdRecipient(\TeamRace\WebBundle\Entity\User $idRecipient = null)
    {
        $this->idRecipient = $idRecipient;

        return $this;
    }

    /**
     * Get idRecipient
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getIdRecipient()
    {
        return $this->idRecipient;
    }

    /**
     * Set idSender
     *
     * @param \TeamRace\WebBundle\Entity\User $idSender
     * @return Messages
     */
    public function setIdSender(\TeamRace\WebBundle\Entity\User $idSender = null)
    {
        $this->idSender = $idSender;

        return $this;
    }

    /**
     * Get idSender
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getIdSender()
    {
        return $this->idSender;
    }
}
