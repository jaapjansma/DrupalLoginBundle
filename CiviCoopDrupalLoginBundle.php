<?php

namespace CiviCoop\DrupalLoginBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use CiviCoop\DrupalLoginBundle\DependencyInjection\Security\Factory\DrupalLoginFactory;

class CiviCoopDrupalLoginBundle extends Bundle
{
	public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new DrupalLoginFactory());
	}
}
