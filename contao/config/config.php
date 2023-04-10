<?php

/*
 * This file is part of RSZ Sponsoren Bundle.
 *
 * (c) Marko Cupic 2023 <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/rsz-sponsoren-bundle
 */

use Markocupic\RszSponsorenBundle\Model\SponsorenModel;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['rsz_tools']['rsz_sponsoren'] = [
    'tables' => ['tl_sponsoren'],
];

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_sponsoren'] = SponsorenModel::class;
