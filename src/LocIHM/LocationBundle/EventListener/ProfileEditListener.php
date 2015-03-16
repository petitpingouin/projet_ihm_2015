<?php

namespace LocIHM\LocationBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProfileEditListener implements EventSubscriberInterface
{
	private $router;

	public function __construct(UrlGeneratorInterface $router)
	{
		$this->router = $router;
	}

	public static function getSubscribedEvents()
	{
		return array(
			FOSUserEvents::PROFILE_EDIT_SUCCESS => 'onProfileEditComplete',
		);
	}

	public function onProfileEditComplete(FormEvent $event)
	{
		$url = $this->router->generate('loc_ihm_location_user_index');
		$event->setResponse(new RedirectResponse($url));
	}
}