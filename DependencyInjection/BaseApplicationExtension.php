<?php
/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Bundle\BaseApplicationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

use Symfony\Component\Finder\Finder;

/**
 * BaseApplicationExtension
 *
 *
 * @author     Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class BaseApplicationExtension extends Extension
{

    /**
     * Loads the url shortener configuration.
     *
     * @param array            $config    An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function configLoad($config, ContainerBuilder $container)
    {

        // register the twig extension
        $container
            ->register('twig.extension.base_application', 'Bundle\BaseApplicationBundle\Twig\Extension\BaseApplicationExtension')
            ->addMethodCall('setTemplating', array(new Reference('templating')))
            ->addTag('twig.extension');

        // register the form generator
//        $definition = new Definition($config['generator']['class']);
//
//        foreach((array)$config['generator']['definitions'] as $name => $definition) {
//            $definition->addMethodCall('addTypes', array($name, $definition));
//        }
//
//        $container->setDefinition('base_appliction.form.generator', $definition);

    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {

        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {

        return 'http://www.sonata-project.org/schema/dic/base-application';
    }

    public function getAlias()
    {

        return "base_application";
    }
}