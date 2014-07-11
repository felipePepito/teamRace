<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamraceChallengeType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		
		$builder->add('description', 'text');
		$builder->add('date', 'datetime');
		$builder->add('maxPoints', 'integer', array('attr' => array('min' => 0)));
		$builder->add('submit', 'submit');
	}
	
	public function getName()
	{
		return 'createTeamraceChallenge';
	}
}