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
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\FilesModel;
use Contao\ModuleModel;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Markocupic\RszSponsorenBundle\Model\SponsorenModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(RszSponsorenListingController::TYPE, category:'rsz_frontend_modules')]
class RszSponsorenListingController extends AbstractFrontendModuleController
{
    public const TYPE = 'rsz_sponsoren_listing';

    public function __construct(
        private readonly Connection $connection,
    ) {
    }

    /**
     * @throws Exception
     */
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
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
                $arrSponsor = $objSponsor->row();

                if ($objSponsor->addImage && $objSponsor->singleSRC) {
                    $objFile = FilesModel::findByUuid($objSponsor->singleSRC);
                    $arrSponsor['imagePath'] = $objFile->path;
                }
                $arrSponsoren[] = $arrSponsor;
            }
        }

        $template->set('sponsoren', $arrSponsoren);

        return $template->getResponse();
    }
}
