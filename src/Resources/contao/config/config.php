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

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['rsz_tools']['rsz_sponsoren'] = array(
'tables' => ['tl_sponsoren']
);

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_sponsoren'] = \Markocupic\RszSponsorenBundle\Model\SponsorenModel::class;
