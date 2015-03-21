<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Model\UserInterface;


/*
 * Controleur de la partie administration
 */
class AdminController extends Controller
{
	
    /**
     * Page listant les utilisateurs de l'application
     */
    public function usersAction()
    {
    	$userManager = $this->container->get('fos_user.user_manager');
    	$users = $userManager->findUsers();

    	return $this->render('LocIHMLocationBundle:Admin:users.html.twig', array(
    		'users' => $users,
    	));
    }


    /*
     * Supprime un utilisateur
     */
    public function deleteUserAction($username, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getUser();
    	$userManager = $this->get('fos_user.user_manager');
    	$userdelete = $userManager->findUserByUsername($username); // Récupère l'utilisateur

    	if (!is_object($userdelete) || !$userdelete instanceof UserInterface) {
            // Vérification basique
            $request->getSession()->getFlashBag()->add('alert', 'Ca c\'est bizarre...');
        } else {
            // Utilisateur existe
	    	if($userdelete === $user) {
                // Empêche le "suicide"
	    		$request->getSession()->getFlashBag()->add('alert', 'Ne vous supprimez pas !');
	    	} else {
	    		$em->remove($userdelete);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Utilisateur supprimé');
	    	}
	    }

    	return $this->redirect($this->generateUrl('loc_ihm_location_admin_users'));
    }

    /*
     * Donne à un utilisateur le rôle ROLE_ADMIN
     */
    public function promoteUserAction($username, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getUser();
    	$userManager = $this->get('fos_user.user_manager');
    	$userPromote = $userManager->findUserByUsername($username);

    	if (!is_object($userPromote) || !$userPromote instanceof UserInterface) {
            $request->getSession()->getFlashBag()->add('alert', 'Ca c\'est bizarre...');
        } else {
            // PROMOTION
    		$userPromote->addRole('ROLE_ADMIN');
    		$userManager->updateUser($userPromote);
			$request->getSession()->getFlashBag()->add('notice', 'Utilisateur promu');
	    }

    	return $this->redirect($this->generateUrl('loc_ihm_location_admin_users'));
    }

    /*
     * Donne à un utilisateur le rôle ROLE_USER
     */
    public function demoteUserAction($username, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getUser();
    	$userManager = $this->get('fos_user.user_manager');
    	$userDemote = $userManager->findUserByUsername($username);

    	if (!is_object($userDemote) || !$userDemote instanceof UserInterface) {
            $request->getSession()->getFlashBag()->add('alert', 'Ca c\'est bizarre...');
        } else {
        	if($userDemote === $user) {
                // Empêche le sabordage
	    		$request->getSession()->getFlashBag()->add('alert', 'Ne vous destituez pas !');
	    	} else {
    			$userDemote->removeRole('ROLE_ADMIN');
    			$userManager->updateUser($userDemote);
				$request->getSession()->getFlashBag()->add('notice', 'Utilisateur destitué !');
			}
	    }

    	return $this->redirect($this->generateUrl('loc_ihm_location_admin_users'));
    }

    /*
     * Affiche l'accueil de l'administrateur
     */
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();

        // Statistiques destinées à un affichage
        $stats['nbContrats'] = $em->getRepository('LocIHMLocationBundle:Contrat')->countContrats();
        $stats['nbContratsEC'] = $em->getRepository('LocIHMLocationBundle:Contrat')->countContratsEnCours();
        $stats['nbVehicules'] = $em->getRepository('LocIHMLocationBundle:Vehicule')->countVehicules();
        $stats['nbVehiculesTourisme'] = $em->getRepository('LocIHMLocationBundle:Vehicule')->countVehiculesByType('Tourisme');
        $stats['nbVehiculesUtilitaire'] = $em->getRepository('LocIHMLocationBundle:Vehicule')->countVehiculesByType('Utilitaire');


        return $this->render('LocIHMLocationBundle:Admin:dashboard.html.twig', array(
            'stats' => $stats,
        ));
    }
}