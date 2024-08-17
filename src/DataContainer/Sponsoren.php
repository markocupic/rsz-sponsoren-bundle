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

use Contao\Backend;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\Image;
use Contao\StringUtil;
use Symfony\Bundle\SecurityBundle\Security;

class Sponsoren extends Backend
{
    private Adapter $image;
    private Adapter $stringUtil;

    public function __construct(
        private readonly Security $security,
        private readonly ContaoFramework $framework,
    ) {
        $this->image = $this->framework->getAdapter(Image::class);
        $this->stringUtil = $this->framework->getAdapter(StringUtil::class);
    }

    /**
     * Return the "toggle visibility" button.
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (!$this->security->isGranted(ContaoCorePermissions::USER_CAN_EDIT_FIELD_OF_TABLE, 'tl_sponsoren::invisible')) {
            return '';
        }

        // Disable the button if the element type is not allowed
        if (!$this->security->isGranted(ContaoCorePermissions::USER_CAN_ACCESS_ELEMENT_TYPE, $row['type'])) {
            return $this->image->getHtml(preg_replace('/\.svg$/i', '_.svg', $icon)).' ';
        }

        $href .= '&amp;id='.$row['id'];

        if ($row['invisible']) {
            $icon = 'invisible.svg';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.$this->stringUtil->specialchars($title).'" onclick="Backend.getScrollOffset();return AjaxRequest.toggleField(this,true)">'.$this->image->getHtml($icon, $label, 'data-icon="'.$this->image->getPath('visible.svg').'" data-icon-disabled="'.$this->image->getPath('invisible.svg').'" data-state="'.($row['invisible'] ? 0 : 1).'"').'</a> ';
    }
}
