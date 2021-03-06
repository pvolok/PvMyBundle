<?php

namespace Pv\MyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PvMyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($config['gen']['enabled']) {
            $loader->load('gen.yml');
            $container->getDefinition('pv.gen.helper')->addArgument($config['gen']['path']);
        }

        if ($config['mongo_session']['enabled']) {
            $loader->load('mongo_session.yml');

            $container->getDefinition('pv.mongo_session.handler')->addArgument(
                array(
                    'database' => $config['mongo_session']['database'],
                    'collection' => $config['mongo_session']['collection'],
                ));
        }
    }
}
