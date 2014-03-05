<?php

namespace Pv\MyBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class HH
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function csrfIsValid($id, $value)
    {
        /** @var CsrfTokenManagerInterface $csrfTokenManager */
        $csrfTokenManager = $this->container->get('security.csrf.token_manager');

        return $csrfTokenManager->isTokenValid(new CsrfToken($id, $value));
    }
}
