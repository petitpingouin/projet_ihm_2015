<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
	// ACCUEIL
    public function reserverAction(Request $request)
    {
        //Vérification de la dispo du véhicule
		$idVeh =  $request->query->get('idveh');

		$dateDepart = new \Datetime('2015-03-19');
		$dateArrivee = new \Datetime('2015-03-19');

		$em = $this->getDoctrine()->getManager();

        $contrats = $em->getRepository('LocIHMLocationBundle:Contrat')->findIdVehUseInContrat($dateDepart, $dateArrivee);
        $veh = $em->getRepository('LocIHMLocationBundle:Vehicule')->isVehNotInContrat($idVeh, $contrats);


        return $this->render('LocIHMLocationBundle:User:user.html.twig', array(
        	'veh' => $veh,
        ));
    }

   
}
