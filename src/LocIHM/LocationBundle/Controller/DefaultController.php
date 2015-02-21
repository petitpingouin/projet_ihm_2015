<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	// ACCUEIL
    public function indexAction()
    {
        return $this->render('LocIHMLocationBundle:Default:layout.html.twig');
    }
}
