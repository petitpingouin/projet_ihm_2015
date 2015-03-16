<?php

namespace LocIHM\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

//use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{

		$builder->add('nom', 'text');
		$builder->add('prenom', 'text');
		$builder->add('dateNaissance', 'date', array(
			'input' => 'datetime',
			'widget' => 'single_text',
			'format' => 'dd/MM/yyyy',
		));
		$builder->add('adresse', 'text');
		$builder->add('tel1', 'text');
		$builder->add('tel2', 'text');
	}

	public function getParent()
	{
		return 'fos_user_registration';
	}

	public function getName()
	{
		return 'locihm_location_user_registration';
	}
}