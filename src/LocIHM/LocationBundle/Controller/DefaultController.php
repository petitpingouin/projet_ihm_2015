<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;
use LocIHM\LocationBundle\Entity\TypeVehicule;



class DefaultController extends Controller
{
	// ACCUEIL
    public function indexAction(Request $request)
    {

    	// Création formulaire
    	$rechercheVeh = new rechercheVehDispo();
    	$rechercheForm = $this->createForm(new rechercheVehDispoType(), $rechercheVeh);
    	$rechercheForm->handleRequest($request);
    	if($rechercheForm->isValid()) {

    	}
    	$r = $this->getDoctrine()->getManager()->getRepository('LocIHMLocationBundle:TypeVehicule');
    	$liste = $r->getTypeByCategoriesQueryBuilder('Tourisme');
 		
        return $this->render('LocIHMLocationBundle:Default:index.html.twig', array(
        	'form' => $rechercheForm->createView(),
        ));
    }
}
