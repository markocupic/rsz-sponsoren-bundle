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

namespace Markocupic\RszSponsorenBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarkocupicRszSponsorenBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
