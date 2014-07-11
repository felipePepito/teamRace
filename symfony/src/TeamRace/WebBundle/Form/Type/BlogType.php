<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BlogType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('headline', 'text');
		$builder->add('text', 'text');
		$builder->add('Create blog entry', 'submit');
	}
	
	public function getName()
	{
		return 'createTeamraceChallenge';
	}
}