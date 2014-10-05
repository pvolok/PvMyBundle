<?php

namespace Pv\MyBundle\PageletLib;

use Symfony\Component\DependencyInjection\ContainerAware;

class AbstractPagelet extends ContainerAware
{
    protected function render($view, array $parameters = array())
    {
        return $this->container->get('templating')->render($view, $parameters);
    }
}
