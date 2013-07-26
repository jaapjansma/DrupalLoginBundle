<?php

namespace CiviCoop\DrupalLoginBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use CiviCoop\DrupalLoginBundle\Security\User\User;

class DrupalProvider implements AuthenticationProviderInterface
{	
	private $providerKey;
	private $http;
	private $url;

    public function __construct($http, $url)
    {
		$this->http = $http;
		$this->url = $url;
    }

    public function authenticate(TokenInterface $token)
    {	
		$response = $this->http->performPostRequest($this->url, array('username' => $token->getUsername(), 'password' => $token->getCredentials()));
		if ($response->getStatusCode() == 200) {
				$user = new User($token->getUsername(), $token->getCredentials(), array('ROLE_USER'));
				$user->setDrupalUser($response->getData()->user);
				
				$authenticatedToken = new UsernamePasswordToken($user, $token->getCredentials(), $token->getProviderKey(), $user->getRoles());
				$authenticatedToken->setAttributes($token->getAttributes());
				
				return $authenticatedToken;
				
				$token->setUser($user);
                $this->securityContext->setToken($token);
		}
		
        throw new AuthenticationException('Bad credentials');
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof UsernamePasswordToken;
    }
}