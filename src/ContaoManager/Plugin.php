<?php

/**
 * This file is part of a markocupic Contao Bundle
 *
 * @copyright  Marko Cupic 2020 <m.cupic@gmx.ch>
 * @author     Marko Cupic
 * @package    RSZ Sponsoren
 * @license    MIT
 * @see        https://github.com/markocupic/rsz-sponsoren-bundle
 *
 */

declare(strict_types=1);

namespace Markocupic\RszSponsorenBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Class Plugin
 *
 * @package Markocupic\RszSponsorenBundle\ContaoManager
 */
class Plugin implements BundlePluginInterface, ConfigPluginInterface
{
    /**
     * @param ParserInterface $parser
     * @return array
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Markocupic\RszSponsorenBundle\MarkocupicRszSponsorenBundle')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle']),
        ];
    }

    /**
     * @param LoaderInterface $loader
     * @param array $managerConfig
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig)
    {
        $loader->load(__DIR__ . '/../Resources/config/parameters.yml');
        $loader->load(__DIR__ . '/../Resources/config/services.yml');
        $loader->load(__DIR__ . '/../Resources/config/listener.yml');
    }

}

