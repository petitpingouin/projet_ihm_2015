<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;
use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\RechercheVehHandler;
use LocIHM\LocationBundle\Entity\Contrat;


class UserController extends Controller
{
	// Résultats de recherche de véhicule
    public function rechercheAction(Request $request)
    {
    	// Récupère les var sessions
    	$session = $request->getSession();

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

            $session->set('reserv_dateDepart', $vehTourisme->getDateDepart());
            $session->set('reserv_dateArrivee', $vehTourisme->getDateArrivee());

            $contrats = $em->getRepository('LocIHMLocationBundle:Contrat')->getAllIdVehUseInContrat($vehTourisme->getDateDepart(), $vehTourisme->getDateArrivee());
            $veh = $em->getRepository('LocIHMLocationBundle:Vehicule')->getVehNotInContrat($vehTourisme->getType(), $contrats);
           
            return $this->render('LocIHMLocationBundle:Default:recherche.html.twig', array(
            'formTourisme' => $formTourisme->createView(),
            'formUtilitaire' => $formUtilitaire->createView(),
            'vehicules' => $veh,
            ));

        }

        $formHandlerUtilitaire = new RechercheVehHandler($vehUtilitaire, $formUtilitaire, $request);
        if($formHandlerUtilitaire->process()) {
            // Formulaire valide
            $em = $this->getDoctrine()->getManager();

            $session->set('reserv_dateDepart', $vehUtilitaire->getDateDepart());
            $session->set('reserv_dateArrivee', $vehUtilitaire->getDateArrivee());

            $contrats = $em->getRepository('LocIHMLocationBundle:Contrat')->getAllIdVehUseInContrat($vehUtilitaire->getDateDepart(), $vehUtilitaire->getDateArrivee());
            $veh = $em->getRepository('LocIHMLocationBundle:Vehicule')->getVehNotInContrat($vehUtilitaire->getType(), $contrats);
           
            return $this->render('LocIHMLocationBundle:Default:recherche.html.twig', array(
            'formTourisme' => $formTourisme->createView(),
            'formUtilitaire' => $formUtilitaire->createView(),
            'vehicules' => $veh,
        ));
        }
    
        return $this->render('LocIHMLocationBundle:Default:recherche.html.twig', array(
            'formTourisme' => $formTourisme->createView(),
            'formUtilitaire' => $formUtilitaire->createView(),
        ));
    }


	
    public function reserverAction(Request $request)
    {
    	// Récupère les var sessions
    	$session = $request->getSession();
		$dateDepart = $session->get('reserv_dateDepart');
		$dateArrivee = $session->get('reserv_dateArrivee');
		$nbJours = $dateDepart->diff($dateArrivee)->format('%R%a') + 1;

		$user = $this->getUser();

		$em = $this->getDoctrine()->getManager();

		// Vérifie si vehicule dispo
		$idVeh =  $request->query->get('idveh');
        $contrats = $em->getRepository('LocIHMLocationBundle:Contrat')->getContratByDateAndIdVeh($idVeh, $dateDepart, $dateArrivee);
        $vehicule = $em->getRepository('LocIHMLocationBundle:Vehicule')->isVehDispo($idVeh, $contrats);

        // Formulaire du forfait
        $contrat = new Contrat();
        $contrat->setDateDebut($dateDepart);
        $contrat->setDateFin($dateArrivee);
        $contrat->setVehicule($vehicule);
        if($user === null) {
        	// Par principe de sécurité
        	return $this->redirectToRoute('fos_user_security_login');
        } else {
       	 	$contrat->setUser($user);
       	}

        $formBuilder = $this->createFormBuilder($contrat)
        	->add('forfait', 'entity', array(
        		'class' => 'LocIHMLocationBundle:Forfait',
        		'property' => 'nom',
        		'placeholder' => 'Choisissez un forfait'))
        	->add('submit', 'submit', array(
    			'attr' => array('class' => 'button')
    	));

        $form = $formBuilder->getForm();

        // MANQUE LA VALIDATION

        return $this->render('LocIHMLocationBundle:User:reserver.html.twig', array(
        	'nbJours' => $nbJours,
        	'form' => $form->createView(),
        	'vehicule' => $vehicule
        ));

    }

    public function rechercherForfaitAction() {
    	$request = $this->get('request');
    	$serializer = $this->container->get('jms_serializer');

    	if($request->isXmlHttpRequest()) {
    		$idFor = $request->request->get('idFor');

    		$em = $this->getDoctrine()->getManager();
    		$forfait = $em->getRepository('LocIHMLocationBundle:Forfait')->find($idFor);


    		return new JsonResponse($serializer->serialize($forfait, 'json'));
    	}
    }
   
}
