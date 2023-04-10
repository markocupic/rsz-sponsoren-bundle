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

namespace Markocupic\RszSponsorenBundle\DataContainer;

use Contao\Controller;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\System;

class Module
{
    #[AsCallback(table: 'tl_module', target: 'fields.rszSponsorLevel.options', priority: 100)]
    public function getSponsorLevels()
    {
        Controller::loadDataContainer('tl_sponsoren');
        System::loadLanguageFile('tl_sponsoren');

        return $GLOBALS['TL_DCA']['tl_sponsoren']['fields']['type']['options'];
    }
}
