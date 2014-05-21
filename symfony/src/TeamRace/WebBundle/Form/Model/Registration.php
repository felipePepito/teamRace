<?php

namespace TeamRace\WebBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use TeamRace\WebBundle\Entity\User;

class Registration 
{
	protected $user;
	protected $termsAccepted;
	
	public function setUser(User $user)
	{
		$this->user = $user;
	}
	
	public function getUser()
	{
		return $this->user;
	}
	
	public function getTermsAccepted()
	{
		return $this->termsAccepted;
	}
	
	public function setTermsAccepted($termsAccepted)
	{
		$this->termsAccepted = (Boolean) $termsAccepted;
	}
	
}