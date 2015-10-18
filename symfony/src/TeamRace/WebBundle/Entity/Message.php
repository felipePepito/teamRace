<?php

namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="sender", columns={"sender"}), @ORM\Index(name="recipient", columns={"recipient"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sender", referencedColumnName="id_user")
     * })
     */
    private $sender;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipient", referencedColumnName="id_user")
     * })
     */
    private $recipient;



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
     * Set text
     *
     * @param string $text
     * @return Message
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
     * @return Message
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
     * Set sender
     *
     * @param \TeamRace\WebBundle\Entity\User $sender
     * @return Message
     */
    public function setSender(\TeamRace\WebBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set recipient
     *
     * @param \TeamRace\WebBundle\Entity\User $recipient
     * @return Message
     */
    public function setRecipient(\TeamRace\WebBundle\Entity\User $recipient = null)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return \TeamRace\WebBundle\Entity\User 
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
