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

namespace Markocupic\RszSponsorenBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Markocupic\RszSponsorenBundle\Model\SponsorenModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(RszSponsorenListingModuleController::TYPE, category:'rsz_frontend_modules', template: 'mod_rsz_sponsoren_listing_module')]
class RszSponsorenListingModuleController extends AbstractFrontendModuleController
{
    public const TYPE = 'rsz_sponsoren_listing_module';

    public function __construct(
        private readonly Connection $connection,
    ) {
    }

    /**
     * @throws Exception
     */
    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {
        $arrSponsoren = [];

        $result = $this->connection->executeQuery(
            'SELECT id FROM tl_sponsoren WHERE type = ? AND invisible = ?',
            [
                $model->rszSponsorLevel,
                '',
            ]
        );

        while (false !== ($row = $result->fetchAssociative())) {
            if (null !== ($objSponsor = SponsorenModel::findByPk($row['id']))) {
                $arrSponsoren[] = $objSponsor;
            }
        }

        $template->arrSponsoren = $arrSponsoren;

        return $template->getResponse();
    }
}
