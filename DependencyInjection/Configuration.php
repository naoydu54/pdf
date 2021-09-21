<?php

namespace Ip\PdfBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ip_pdf');

        $rootNode
            ->children()
                ->arrayNode('pages')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('orientation')->end()
                            ->scalarNode('format')->end()
                            ->scalarNode('lang')->end()
                            ->booleanNode('unicode')->end()
                            ->scalarNode('encoding')->end()
                            ->arrayNode('margin')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('default_page')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
