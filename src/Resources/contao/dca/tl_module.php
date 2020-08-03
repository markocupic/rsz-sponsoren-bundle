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
 * Frontend modules
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['rsz_sponsoren_listing_module'] = '{title_legend},name,headline,type;{config_legend},rszSponsorLevel;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['rszSponsorLevel'] = [
    'exclude'          => true,
    'filter'           => true,
    'inputType'        => 'select',
    'options_callback' => ['tl_module_rsz_sponsoren', 'getSponsorLevels'],
    'reference'        => &$GLOBALS['TL_LANG']['tl_sponsoren'],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(32) NOT NULL default 'main'"
];

/**
 * Class tl_module_rsz_sponsoren
 */
class tl_module_rsz_sponsoren extends \Contao\Backend
{
    /**
     * tl_module_rsz_sponsoren constructor.
     */
    public function __construct()
    {

        return parent::__construct();
    }

    public function getSponsorLevels()
    {

        \Contao\Controller::loadDataContainer('tl_sponsoren');
        \Contao\System::loadLanguageFile('tl_sponsoren');
        return $GLOBALS['TL_DCA']['tl_sponsoren']['fields']['type']['options'];
    }

}
