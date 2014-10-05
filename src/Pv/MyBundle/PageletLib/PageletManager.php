<?php

namespace Pv\MyBundle\PageletLib;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class PageletManager
{
    private $container;
    private $cachedPagelets = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function render($name, array $args)
    {
        $action = $this->getAction($name);
        $args = new PageletArgs($args);
        return $action($args);
    }

    private function getAction($name)
    {
        if (!isset($this->cachedPagelets[$name])) {
            list($bundleName, $pageletName, $actionName) =
                explode(':', $name, 3);
            $pageletName .= 'Pagelet';
            $actionName .= 'Action';

            /** @var KernelInterface $kernel */
            $kernel = $this->container->get('kernel');
            $class = $kernel->getBundle($bundleName)->getNamespace() .
                '\\Pagelet\\' . $pageletName;

            $pagelet = new $class();
            if ($pagelet instanceof ContainerAwareInterface) {
                $pagelet->setContainer($this->container);
            }

            $this->cachedPagelets[$name] = [$pagelet, $actionName];
        }

        return $this->cachedPagelets[$name];
    }
}
