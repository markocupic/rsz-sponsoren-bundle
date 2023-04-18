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
 * Frontend modules
 */
$GLOBALS['TL_DCA']['tl_module']['palettes'][RszSponsorenListingController::TYPE] = '
    {title_legend},name,headline,type;
    {config_legend},rszSponsorLevel;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID
';

$GLOBALS['TL_DCA']['tl_module']['fields']['rszSponsorLevel'] = [
    'exclude'   => true,
    'filter'    => true,
    'inputType' => 'select',
    'reference' => &$GLOBALS['TL_LANG']['tl_sponsoren'],
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(32) NOT NULL default 'main'",
];
