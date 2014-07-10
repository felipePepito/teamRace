<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamraceChallengeType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		
		$builder->add('name', 'text');
		$builder->add('Create Team', 'submit');
	}
	
	public function getName()
	{
		return 'createTeamraceChallenge';
	}
}