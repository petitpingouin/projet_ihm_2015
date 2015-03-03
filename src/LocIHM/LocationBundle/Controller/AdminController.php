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
}
