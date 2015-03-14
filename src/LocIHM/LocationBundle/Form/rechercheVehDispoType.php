<?php

namespace LocIHM\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityManager;

use LocIHM\LocationBundle\Entity\TypeVehiculeRepository;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;


class rechercheVehDispoType extends AbstractType
{

	protected $categorie;
	protected $name;

	public function __construct($name = 'rechVeh', $categorie = 'Tourisme')
	{
		$this->name = 'LocIHM_LocationBundle_rechercheVehDispo_'.$name;
		$this->categorie = $categorie;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{

		$builder
			->add('type', 'entity', array(
				'query_builder' => function(TypeVehiculeRepository $repo) {
					return $repo->getTypeByCategoriesQueryBuilder($this->categorie);
				},
				'property' => 'nom',
				'class' => 'LocIHM\LocationBundle\Entity\TypeVehicule'))
    		->add('dateDepart', 'date', array(
    			'input' => 'datetime',
    			'widget' => 'single_text',
    			'format' => 'dd-MM-yyyy',
    			))
    		->add('dateArrivee', 'date', array(
    			'input' => 'string',
    			'widget' => 'single_text',
    			'format' => 'dd-MM-yyyy',
    			))
    		->add('name', 'hidden')
    		->add('recherche', 'submit', array(
    			'attr' => array('class' => 'button')
    			))
    	;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	/**
	 * @return string
	 */
	public function getCategorie()
	{
		return $this->categorie;
	} 

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		
		$resolver->setDefaults(array(
			'data_class' => 'LocIHM\LocationBundle\Form\Data\RechercheVehDispo',
			'categorie' => null,
			'name' => null));
	}
}
