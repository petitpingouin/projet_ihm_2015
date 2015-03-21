<?php
// src/LocIHM/LocationBundle/Form/Type/RegistrationFormType.php
namespace LocIHM\LocationBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/*
 * Override le formulaire d'inscription de fosuserbundle
 */
class RegistrationFormType extends BaseType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);
		
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
	
	public function getName()
	{
		return 'locihm_location_registration';
	}
}
?>