<?php

namespace LocIHM\LocationBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;

/*
 * Contrôle du formulaire de recherche de véhicule
 * Permet de distinguer les formulaire selon le nom du formulaire
 */
class RechercheVehHandler
{
	protected $rechVeh;
	protected $form;
	protected $request;

	public function __construct(RechercheVehDispo $rechVeh, Form $form, Request $request)
	{
		$this->rechVeh = $rechVeh;
		$this->form = $form;
		$this->request = $request;
	}

	public function process()
	{
		$valeurs = $this->request->request->get($this->form->getName());
		
		if($this->request->getMethod() === 'POST' && $valeurs['name'] === $this->rechVeh->getName()) {
			$this->form->submit($this->request);

			if($this->form->isValid()) {
				return true;
			}
		}

		return false;
	}
}