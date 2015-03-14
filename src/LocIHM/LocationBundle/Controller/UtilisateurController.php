<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;
use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\RechercheVehHandler;



class UtilisateurController extends Controller
{
	// ACCUEIL
    public function reserverAction(Request $request)
    {
        

        return $this->render('LocIHMLocationBundle:Default:index.html.twig', array(
        	'formTourisme' => $formTourisme->createView(),
            'formUtilitaire' => $formUtilitaire->createView(),
        ));
    }

   
}
