<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateTeamRaceType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('name', 'text');
		$builder->add('description', 'text');
		$builder->add('Create TeamRace', 'submit');
	}
	
	public function getName()
	{
		return 'createTeamRace';
	}
}