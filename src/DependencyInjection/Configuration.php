<?php

namespace Softspring\GcloudIntegrationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sfs_gcloud_integration');

        $rootNode
            ->children()
                ->arrayNode('logging')
                    ->canBeEnabled()
                    ->children()
                        // ->scalarNode('gcloud_project_id')->end()
                        ->scalarNode('level')->defaultValue('debug')->end()
                        ->booleanNode('bubble')->defaultTrue()->end()
                        ->arrayNode('logger')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('name')->defaultValue('global')->info('The name of the log to write entries to.')->end()
                                ->arrayNode('resource')->info('The monitored resource to associate log entries with. https://cloud.google.com/logging/docs/api/reference/rest/v2/MonitoredResource')->end()
                                ->arrayNode('labels')->info('A set of user-defined (key, value) data that provides additional information about the log entry.')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}