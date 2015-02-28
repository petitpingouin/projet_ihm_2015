<?php

namespace LocIHM\LocationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LocIHMLocationBundle extends Bundle
{
	public function getParent() {
		return 'FOSUserBundle';
	}
}
