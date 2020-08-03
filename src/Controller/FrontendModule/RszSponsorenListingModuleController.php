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

declare(strict_types=1);

namespace Markocupic\RszSponsorenBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\Database;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\Template;
use Markocupic\RszSponsorenBundle\Model\SponsorenModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class RszSponsorenListingModuleController
 *
 * @package Markocupic\RszSponsorenBundle\Controller\FrontendModule
 */
class RszSponsorenListingModuleController extends AbstractFrontendModuleController
{
    /**
     * @var PageModel
     */
    protected $page;

    /**
     * RszSponsorenListingModuleController constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct()
    {
        //
    }

    /**
     * This method extends the parent __invoke method,
     * its usage is usually not necessary
     *
     * @param Request $request
     * @param ModuleModel $model
     * @param string $section
     * @param array|null $classes
     * @param PageModel|null $page
     * @return Response
     */
    public function __invoke(Request $request, ModuleModel $model, string $section, array $classes = null, PageModel $page = null): Response
    {

        // Get the page model
        $this->page = $page;

        if ($this->page instanceof PageModel && $this->get('contao.routing.scope_matcher')->isFrontendRequest($request))
        {
            // If TL_MODE === 'FE'
            $this->page->loadDetails();
        }

        return parent::__invoke($request, $model, $section, $classes);
    }

    /**
     * Lazyload some services
     *
     * @return array
     */
    public static function getSubscribedServices(): array
    {

        $services = parent::getSubscribedServices();
        return $services;
    }

    /**
     * @param Template $template
     * @param ModuleModel $model
     * @param Request $request
     * @return null|Response
     */
    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {

        $arrSponsoren = [];

        $objSponsoren = Database::getInstance()
            ->prepare('SELECT * FROM tl_sponsoren WHERE type=? AND disable=?')
            ->execute($model->rszSponsorLevel, '');
        while ($objSponsoren->next())
        {
            if (null !== ($objSponsor = SponsorenModel::findByPk($objSponsoren->id)))
            {
                $arrSponsoren[] = $objSponsor;
            }
        }
        $template->arrSponsoren = $arrSponsoren;

        return $template->getResponse();
    }
}
