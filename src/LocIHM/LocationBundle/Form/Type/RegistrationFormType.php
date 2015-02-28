<?php
// src/LocIHM/LocationBundle/Form/Type/RegistrationFormType.php
namespace LocIHM\LocationBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterType extends BaseType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		parent::buildForm($builder, $option);
		
		$builder->add('nom', 'text');
		$builder->add('prenom', 'text');
		$builder->add('dateNaissance', 'date');
		$builder->add('adresse', 'text');
		$builder->add('tel1', 'text');
		$builder->add('tel2', 'text');
	}
	
	public function getName()
	{
		return 'locihm_user_registration';
	}
}
?>