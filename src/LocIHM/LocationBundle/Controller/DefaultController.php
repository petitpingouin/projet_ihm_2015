<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;
use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\RechercheVehHandler;



class DefaultController extends Controller
{
	// ACCUEIL
    public function indexAction(Request $request)
    {

    	// Création formulaire
    	$vehTourisme = new RechercheVehDispo('Tourisme', 'Tourisme');
        $vehUtilitaire = new RechercheVehDispo('Utilitaire', 'Utilitaire');

    	 $formTourisme = $this->createForm(new rechercheVehDispoType($vehTourisme->getName(), $vehTourisme->getCategorie()), $vehTourisme, array(
            'action' => $this->generateUrl('loc_ihm_location_recherche'),
        ));
        $formUtilitaire = $this->createForm(new rechercheVehDispoType($vehUtilitaire->getName(), $vehUtilitaire->getCategorie()), $vehUtilitaire,array(
            'action' => $this->generateUrl('loc_ihm_location_recherche'),
        ));

        /*
        $formHandlerTourisme = new RechercheVehHandler($vehTourisme, $formTourisme, $request);
    	if($formHandlerTourisme->process()) {
            // Formulaire valide
            
    	}

        $formHandlerUtilitaire = new RechercheVehHandler($vehUtilitaire, $formUtilitaire, $request);
        if($formHandlerUtilitaire->process()) {
            // Formulaire valide
        }
	   */
        return $this->render('LocIHMLocationBundle:Default:index.html.twig', array(
        	'formTourisme' => $formTourisme->createView(),
            'formUtilitaire' => $formUtilitaire->createView(),
        ));
    }

    // Résultats de recherche de véhicule
    public function rechercheAction(Request $request)
    {
        // Création formulaire
        $vehTourisme = new RechercheVehDispo('Tourisme', 'Tourisme');
        $vehUtilitaire = new RechercheVehDispo('Utilitaire', 'Utilitaire');

        $formTourisme = $this->createForm(new rechercheVehDispoType($vehTourisme->getName(), $vehTourisme->getCategorie()), $vehTourisme, array(
            'action' => $this->generateUrl('loc_ihm_location_recherche'),
        ));
        $formUtilitaire = $this->createForm(new rechercheVehDispoType($vehUtilitaire->getName(), $vehUtilitaire->getCategorie()), $vehUtilitaire,array(
            'action' => $this->generateUrl('loc_ihm_location_recherche'),
        ));

        $formHandlerTourisme = new RechercheVehHandler($vehTourisme, $formTourisme, $request);
        if($formHandlerTourisme->process()) {
            // Formulaire valide
            
            $em = $this->getDoctrine()->getManager();
            /*
            $typesIndispos = $em
                ->getRepository('LocIHMLocationBundle:Contrat')
                ->findByDateType($vehTourisme->getType()->getId(), $vehTourisme->getDateDepart(), $vehTourisme->getDateArrivee())
            ;*/
            $requete = $em
                ->getRepository('LocIHMLocationBundle:Contrat')
                ->findByDateType($vehTourisme->getType()->getId(), $vehTourisme->getDateDepart(), $vehTourisme->getDateArrivee())
            ;

            $vehicules = $em
                ->getRepository('LocIHMLocationBundle:Vehicule')
                ->getVehNotInContrat($vehTourisme->getType()->getId(), $requete)
            ;
    
            foreach($vehicules as $vehicules) {
                print_r($vehicules->getVehicule()->getId());
            }

        }

        $formHandlerUtilitaire = new RechercheVehHandler($vehUtilitaire, $formUtilitaire, $request);
        if($formHandlerUtilitaire->process()) {
            // Formulaire valide
        }
    
        return $this->render('LocIHMLocationBundle:Default:recherche.html.twig', array(
            'formTourisme' => $formTourisme->createView(),
            'formUtilitaire' => $formUtilitaire->createView(),
        ));
    }
    
}
