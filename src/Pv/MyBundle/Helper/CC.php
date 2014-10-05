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
