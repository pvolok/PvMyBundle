<?php

namespace Pv\MyBundle\PageletLib;

use Pv\MyBundle\Helper\CC;
use Pv\MyBundle\Helper\HH;
use Symfony\Component\DependencyInjection\ContainerAware;

abstract class AbstractPagelet extends ContainerAware
{
    /**
     * @return HH
     */
    protected function hh()
    {
        return $this->container->get('pv.hh');
    }

    /**
     * @return CC
     */
    protected function cc()
    {
        return $this->container->get('pv.cc');
    }

    protected function render($view, array $parameters = array())
    {
        return $this->container->get('templating')->render($view, $parameters);
    }
}
