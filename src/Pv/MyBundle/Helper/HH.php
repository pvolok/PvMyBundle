<?php

namespace Pv\MyBundle\Helper;

use Pv\MyBundle\PageletLib\PageletManager;
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
        $id = $id ?: 'pv_def';

        /** @var CsrfTokenManagerInterface $csrfTokenManager */
        $csrfTokenManager = $this->container->get('security.csrf.token_manager');

        return $csrfTokenManager->isTokenValid(new CsrfToken($id, $value));
    }

    public function pagelet($name, $args = [])
    {
        /** @var PageletManager $pm */
        $pm = $this->container->get('pv.pagelet_manager');
        return $pm->render($name, $args);
    }
}
