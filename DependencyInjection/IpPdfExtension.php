<?php

namespace Ip\PdfBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class IpPdfExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        foreach ($config as $key => $value) {
            switch ($key){
                case 'pages':
                    $this->bindPages($value, $container);
                    break;
                default:
                    $container->setParameter(sprintf('ip_pdf.%s', $key), $value);
                    break;
            }
        }
    }

    public function bindPages($config, ContainerBuilder $container){

        $pages = [];

        foreach ($config as $key => $value){
            foreach ($value as $k => $v){
                $pages[$key][$k] = $v;
                $container->setParameter(sprintf('ip_pdf.pages.%s.%s', $key, $k), $v);
            }
        }

        $container->setParameter(sprintf('ip_pdf.pages'), $pages);
    }
}
