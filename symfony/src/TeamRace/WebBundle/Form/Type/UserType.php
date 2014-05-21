<?php

namespace TeamRace\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('email', 'email');
		$builder->add('pw', 'repeated', array(
				'first_name' => 'password',
				'second_name' => 'confirm',
				'type' => 'password'
		));
		$builder->add('firstName', 'text');
		$builder->add('lastName', 'text');
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'TeamRace\WebBundle\Entity\User'
		));
	}
	
	public function getName() 
	{
		return 'user';
	}
}