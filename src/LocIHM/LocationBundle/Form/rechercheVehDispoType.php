<?php

namespace LocIHM\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityRepository;

use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo as ObjetR;


class rechercheVehDispoType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('categorie', 'choice', array(
    			'choices' => array('Tourisme' => 'Tourisme', 'Utilitaire' => 'Utilitaire'),
    			'multiple' => false,
    			'expanded' => true))
    		->add('dateDepart', 'date', array(
    			'input' => 'string',
    			'widget' => 'single_text',
    			'format' => 'dd-MM-yyyy'))
    		->add('dateArrivee', 'date', array(
    			'input' => 'string',
    			'widget' => 'single_text',
    			'format' => 'dd-MM-yyyy'))
    	;

		$formModifier = function(FormInterface $form, $categorie = null)
		{
			if($categorie === null) {
				$types = array();
				$form->add('type', 'entity', array(
					'class' => 'LocIHMLocationBundle:TypeVehicule',
					'placeholder' => '',
					'choices' => $types,
				));

			} else {
				echo 'wouhou';
				$form->add('type', 'entity', array(
					'class' => 'LocIHMLocationBundle:TypeVehicule',
					'query_builder' => function(TypeVehiculeRepository $r, $categorie) {
						return $r->createQueryBuilder('type')
							->where('type.categorie = :cat')
							->setParameter('cat', $categorie);
					},
					'placeholder' => '',
					'property' => 'nom',
				));
			}
		};

		
		$builder->addEventListener(
			FormEvents::PRE_SET_DATA,
			function (FormEvent $event) use ($formModifier) {
				$data = $event->getData();
				
				$formModifier($event->getForm(), $data->getCategorie());
			}
		);
		

		$builder->get('categorie')->addEventListener(
			FormEvents::POST_SUBMIT,
			function (FormEvent $event) use ($formModifier) {
				
				$categorie = $event->getForm()->get('categorie');

				$formModifier($event->getForm()->getParent(), $categorie);	
			}
		);

	}

	

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'LocIHM_LocationBundle_rechercheVehDispo';
	} 
}
