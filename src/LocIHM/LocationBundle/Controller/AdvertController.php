<?php

// src/LocIHM/LocationBundle/Controller/AdvertController.php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class AdvertController
{
	public function indexAction()
	{
		return new Response("Hello World !");
	}
}