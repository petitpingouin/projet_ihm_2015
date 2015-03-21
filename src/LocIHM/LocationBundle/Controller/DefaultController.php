<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use LocIHM\LocationBundle\Form\rechercheVehDispoType;
use LocIHM\LocationBundle\Form\Data\RechercheVehDispo;
use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\RechercheVehHandler;


/*
 * Contrôleur par défaut
 */
class DefaultController extends Controller
{
	/*
     * Accueil
     */
    public function indexAction(Request $request)
    {

        if($this->get('security.context')->isGranted('ROLE_USER')) {

        	// Création formulaire de recherche

            // Entités des formulaires
        	$vehTourisme = new RechercheVehDispo('Tourisme', 'Tourisme');
            $vehUtilitaire = new RechercheVehDispo('Utilitaire', 'Utilitaire');

            // Formulaires
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

    /*
     * Switch le style du site
     */
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

        $url = $request->headers->get('referer');   // récupère l'url d'origine

        if(empty($url)) {
            // Redirection par défaut
            return $this->redirect($this->generateUrl('loc_ihm_location_homepage'));
        }

        // Redirection
        return $this->redirect($url);
    }

    /*
     * Génère le flux RSS avec le bundle feedbundle et l'entité Vehicule
     */
    public function feedVehiculesAction()
    {
        $vehicules = $this->getDoctrine()->getRepository('LocIHMLocationBundle:Vehicule')->findAll();

        $feed = $this->get('eko_feed.feed.manager')->get('Vehicule');
        $feed->addFromArray($vehicules);

        return new Response($feed->render('rss'));
    }
}
