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

use Markocupic\RszSponsorenBundle\Controller\FrontendModule\RszSponsorenListingController;

/**
 * Backend modules
 */
$GLOBALS['TL_LANG']['MOD']['rsz_tools'] = 'RSZ Tools';
$GLOBALS['TL_LANG']['MOD']['rsz_sponsoren'] = ['RSZ Sponsoren und Gönner', 'Administrieren Sie die RSZ Sponsoren und Gönner'];

/**
* Frontend modules
*/
$GLOBALS['TL_LANG']['FMD']['rsz_frontend_modules'] = 'RSZ Frontendmodule';
$GLOBALS['TL_LANG']['FMD'][RszSponsorenListingController::TYPE] = ['RSZ Sponsorenliste', 'Erstellen Sie eine RSZ Sponsorenliste'];
