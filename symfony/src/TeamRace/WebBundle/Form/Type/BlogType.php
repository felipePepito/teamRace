<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BlogType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('headline', 'text', array(
    		'attr' => array('size' => '50')));
		$builder->add('text', 'textarea', array(
    		'attr' => array('cols' => '54', 'rows' => '5')));
		$builder->add('submit', 'submit');
	}
	
	public function getName()
	{
		return 'createTeamraceChallenge';
	}
}