<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('user', new UserType());
		$builder->add('I_read_and_accept_the_terms_of_usage', 'checkbox', array('property_path' => 'terms_accepted'));
		$builder->add('Register', 'submit');
	}
	
	public function getName()
	{
		return 'registration';
	}
}