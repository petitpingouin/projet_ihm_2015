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

        if($this->get('security.context')->isGranted('ROLE_USER')) {

        	// Création formulaire de recherche
        	$vehTourisme = new RechercheVehDispo('Tourisme', 'Tourisme');
            $vehUtilitaire = new RechercheVehDispo('Utilitaire', 'Utilitaire');

        	 $formTourisme = $this->createForm(new rechercheVehDispoType($vehTourisme->getName(), $vehTourisme->getCategorie()), $vehTourisme, array(
                'action' => $this->generateUrl('loc_ihm_location_recherche'),
            ));
            $formUtilitaire = $this->createForm(new rechercheVehDispoType($vehUtilitaire->getName(), $vehUtilitaire->getCategorie()), $vehUtilitaire,array(
                'action' => $this->generateUrl('loc_ihm_location_recherche'),
            ));

            return $this->render('LocIHMLocationBundle:Default:index.html.twig', array(
            	'formTourisme' => $formTourisme->createView(),
                'formUtilitaire' => $formUtilitaire->createView(),
            ));
        } else {
            return $this->render('LocIHMLocationBundle:Default:index.html.twig');
        }
    }

    public function changeStyleAction(Request $request)
    {
        // Récupère les var sessions
        $session = $request->getSession();
        $style = $session->get('style');

        if($style == 'rouge') {
            $session->set('style', 'bleu');
        } else {
            $session->set('style', 'rouge');
        }

        $url = $request->headers->get('referer');
        if(empty($url)) {
            return $this->redirect($this->generateUrl('loc_ihm_location_homepage'));
        }
        return $this->redirect($url);
    }

    public function feedVehiculesAction()
    {
        $vehicules = $this->getDoctrine()->getRepository('LocIHMLocationBundle:Vehicule')->findAll();

        $feed = $this->get('eko_feed.feed.manager')->get('Vehicule');
        $feed->addFromArray($vehicules);

        return new Response($feed->render('rss'));
    }
    
}
