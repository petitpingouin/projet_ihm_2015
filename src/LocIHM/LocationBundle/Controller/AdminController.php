<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Model\UserInterface;



class AdminController extends Controller
{
	// ACCUEIL
    public function indexAction()
    {
        return $this->render('LocIHMLocationBundle:Admin:index.html.twig');
    }

    public function usersAction()
    {
    	$userManager = $this->container->get('fos_user.user_manager');
    	$users = $userManager->findUsers();

    	return $this->render('LocIHMLocationBundle:Admin:users.html.twig', array(
    		'users' => $users,
    	));
    }


    /*
     * $username => username
     */
    public function deleteUserAction($username, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getUser();
    	$userManager = $this->get('fos_user.user_manager');
    	$userdelete = $userManager->findUserByUsername($username);

    	if (!is_object($userdelete) || !$userdelete instanceof UserInterface) {
            $request->getSession()->getFlashBag()->add('alert', 'Ca c\'est bizarre...');
        } else {
	    	if($userdelete === $user) {
	    		$request->getSession()->getFlashBag()->add('alert', 'Ne vous supprimez pas !');
	    	} else {
	    		$em->remove($userdelete);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Utilisateur supprimé');
	    	}
	    }

    	return $this->redirect($this->generateUrl('loc_ihm_location_admin_users'));
    }

    public function promoteUserAction($username, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getUser();
    	$userManager = $this->get('fos_user.user_manager');
    	$userPromote = $userManager->findUserByUsername($username);

    	if (!is_object($userPromote) || !$userPromote instanceof UserInterface) {
            $request->getSession()->getFlashBag()->add('alert', 'Ca c\'est bizarre...');
        } else {
    		$userPromote->addRole('ROLE_ADMIN');
    		$userManager->updateUser($userPromote);
			$request->getSession()->getFlashBag()->add('notice', 'Utilisateur promu');
	    }

    	return $this->redirect($this->generateUrl('loc_ihm_location_admin_users'));
    }

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
	    		$request->getSession()->getFlashBag()->add('alert', 'Ne vous destituez pas !');
	    	} else {
    			$userDemote->removeRole('ROLE_ADMIN');
    			$userManager->updateUser($userDemote);
				$request->getSession()->getFlashBag()->add('notice', 'Utilisateur destitué !');
			}
	    }

    	return $this->redirect($this->generateUrl('loc_ihm_location_admin_users'));
    }
}