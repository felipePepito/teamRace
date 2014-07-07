<?php

namespace TeamRace\WebBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class AddMember 
{
	/**
	 * @Assert\NotBlank()
	 */
	protected $email;
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	
}