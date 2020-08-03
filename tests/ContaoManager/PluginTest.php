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

namespace Markocupic\RszSponsorenBundle\Tests\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\DelegatingParser;
use Contao\TestCase\ContaoTestCase;
use Markocupic\RszSponsorenBundle\ContaoManager\Plugin;
use Markocupic\RszSponsorenBundle\MarkocupicRszSponsorenBundle;

/**
 * Class PluginTest
 *
 * @package Markocupic\RszSponsorenBundle\Tests\ContaoManager
 */
class PluginTest extends ContaoTestCase
{
    /**
     * Test Contao manager plugin class instantiation
     */
    public function testInstantiation(): void
    {
        $this->assertInstanceOf(Plugin::class, new Plugin());
    }

    /**
     * Test returns the bundles
     */
    public function testGetBundles(): void
    {
        $plugin = new Plugin();

        /** @var array $bundles */
        $bundles = $plugin->getBundles(new DelegatingParser());

        $this->assertCount(1, $bundles);
        $this->assertInstanceOf(BundleConfig::class, $bundles[0]);
        $this->assertSame(MarkocupicRszSponsorenBundle::class, $bundles[0]->getName());
        $this->assertSame([ContaoCoreBundle::class], $bundles[0]->getLoadAfter());
    }

}
