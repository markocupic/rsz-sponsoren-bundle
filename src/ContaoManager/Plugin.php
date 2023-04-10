<?php

declare(strict_types=1);

/*
 * This file is part of RSZ Sponsoren Bundle.
 *
 * (c) Marko Cupic 2023 <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/rsz-sponsoren-bundle
 */

namespace Markocupic\RszSponsorenBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Markocupic\RszBenutzerverwaltungBundle\MarkocupicRszBenutzerverwaltungBundle;
use Markocupic\RszSponsorenBundle\MarkocupicRszSponsorenBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(MarkocupicRszSponsorenBundle::class)
                ->setLoadAfter([
                    MarkocupicRszBenutzerverwaltungBundle::class,
                    ContaoCoreBundle::class,
                ]),
        ];
    }
}
