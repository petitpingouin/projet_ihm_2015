<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
	// ACCUEIL
    public function indexAction()
    {
        return $this->render('LocIHMLocationBundle:Admin:index.html.twig');
    }

    public function usersAction()
    {
    	$userManager = $container->get('fos_user.user_manager');
    	$users = $userManager->findUsers();

    	return $this->render('LocIHMLocationBundle:Admin:users.html.twig', array(
    		'users' => $users,
    	));
    }

    public function addUserAction()
    {
    	
    }
}
