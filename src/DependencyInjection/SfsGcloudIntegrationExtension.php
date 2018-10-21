<?php

namespace Softspring\GcloudIntegrationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class SfsGcloudIntegrationExtension
 */
class SfsGcloudIntegrationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        if ($config['logging']['enabled']) {
            $container->setParameter('sfs_gcloud_integration.logging.level', $config['logging']['level']);
            $container->setParameter('sfs_gcloud_integration.logging.bubble', $config['logging']['bubble']);
            $container->setParameter('sfs_gcloud_integration.logging.logger.name', $config['logging']['logger']['name']);

            $typesAndFactoryMethods = [
                'logger' => 'logger',
                'psr' => 'psrLogger',
                'psr_batch' => 'psrBatchLogger',
            ];
            $container->setParameter('sfs_gcloud_integration.logging.logger.factoryMethod', $typesAndFactoryMethods[$config['logging']['logger']['type']]);

            $container->setParameter('sfs_gcloud_integration.logging.logger.options', [
                'resource' => !empty($config['logging']['logger']['resource']) ? $config['logging']['logger']['resource'] : null,
                'labels' => !empty($config['logging']['logger']['labels']) ? $config['logging']['logger']['labels'] : null,
            ]);

            $loader->load('logging.yaml');
        }

        if ($config['error_reporting']['enabled']) {
            $loader->load('error_reporting.yaml');
        }
    }
}
