<?php
namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddMemberType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('email', 'email');
		$builder->add('Add User', 'submit');
	}
	
	public function getName()
	{
		return 'addUser';
	}
}