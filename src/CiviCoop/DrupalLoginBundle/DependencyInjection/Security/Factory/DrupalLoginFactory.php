<?php

namespace CiviCoop\DrupalLoginBundle\DependencyInjection\Security\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;

class DrupalLoginFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {		
		$providerId = 'security.authentication.provider.drupal.'.$id;
        $providerDD = new DefinitionDecorator(
                          'drupal.security.authentication.provider');

        $container->setDefinition($providerId, $providerDD);

        $listenerId = 'security.authentication.listener.drupal.'.$id;
        $listenerDD = new DefinitionDecorator(
                              'drupal.security.authentication.listener');
        $listener = $container->setDefinition($listenerId, $listenerDD);
		

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'drupal';
    }

    public function addConfiguration(NodeDefinition $node)
    {
    }
}