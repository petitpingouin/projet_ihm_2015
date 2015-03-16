<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Model\UserInterface;

use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;
use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\RechercheVehHandler;
use LocIHM\LocationBundle\Entity\Contrat;
use LocIHM\LocationBundle\Form\ContratType;


class UserController extends Controller
{
    // Accueil de l'utilisateur
    public function indexAction()
    {
    	$user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();


        $contrats = $em->getRepository('LocIHMLocationBundle:Contrat')->getContratByDateAndUser($user);
        $contratsP = $em->getRepository('LocIHMLocationBundle:Contrat')->getContratPassedByDateAndUser($user);


        return $this->render('LocIHMLocationBundle:User:user.html.twig', array(
        	'user' => $user,
            'contrats' => $contrats,
            'contratsP' => $contratsP,
        ));
    }

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


        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $formBuilder = $this->createFormBuilder($contrat)
            ->add('forfait', 'entity', array(
                'class' => 'LocIHMLocationBundle:Forfait',
                'property' => 'nom',
                'placeholder' => 'Choisissez un forfait'
        ))
            ->add('user', 'entity', array(
                'class' => 'LocIHMLocationBundle:User',
                'property' => 'username',
                'placeholder' => 'Choisissez un utilisateur'));
        }
        else{
            $formBuilder = $this->createFormBuilder($contrat)
            ->add('forfait', 'entity', array(
                'class' => 'LocIHMLocationBundle:Forfait',
                'property' => 'nom',
                'placeholder' => 'Choisissez un forfait'
        ));
        }

        $form = $formBuilder->getForm();

        // Validation
        $form->handleRequest($request);

        if($form->isValid()) {
            $em->persist($contrat);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Réservation enregistrée');

            return $this->redirect($this->generateUrl('loc_ihm_location_user_index'));
        }

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

	/**
	* Deletes a Contrat entity.
	*
	*/
    public function deleteAction(Request $request, $id)
    {
    	$user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $contrat = $em->getRepository('LocIHMLocationBundle:Contrat')->find($id);

        if (!$contrat) {
            throw $this->createNotFoundException('Unable to find Contrat entity.');
        } else {
	        if($contrat->getUser() != $user) {
	        	$request->getSession()->getFlashBag()->add('alert', 'Petit malin !');
	        } else {
	            $em->remove($contrat);
	            $em->flush();
	        }
	    }

        return $this->redirect($this->generateUrl('loc_ihm_location_user_index'));
    }
   
}
