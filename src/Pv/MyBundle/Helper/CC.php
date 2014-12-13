<?php

namespace Pv\MyBundle\Helper;

use Doctrine\ODM\MongoDB\DocumentManager;
use Pv\MyBundle\Gen\GenHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CC
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @return HH
     */
    public function hh()
    {
        return $this->container->get('pv.hh');
    }

    /**
     * @return DocumentManager
     */
    public function dm()
    {
        return $this->container->get('doctrine.odm.mongodb.document_manager');
    }

    /**
     * @return GenHelper
     */
    public function gen()
    {
        return $this->container->get('pv.gen.helper');
    }
}
