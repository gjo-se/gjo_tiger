<?php
namespace GjoSe\GjoTiger\Controller;

/***************************************************************
 *  created: 05.09.17 - 14:46
 *  Copyright notice
 *  (c) 2017 Gregory Jo Erdmann <gregory.jo@gjo-se.com>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ProductController
 * @package GjoSe\GjoTiger\Controller
 */
class ProductController extends AbstractController
{

    /**
     * return void
     */
    public function showProductGroupTeaserAction()
    {
        $this->view->assignMultiple([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup'])
        ]);
    }

    public function showProductGroupAction()
    {
        $this->view->assignMultiple([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup'])
        ]);
    }

    public function showProductSetAction()
    {
        $productSet = $this->productSetRepository->findByUid($this->settings['productSet']);

        $productSetTypeUid = $this->productSetTypeRepository->findProductSetTypeUidByProductSetUid($productSet->getUid(), 1);
        $productSetType    = $this->productSetTypeRepository->findByUid($productSetTypeUid);

        $productGroup = null;
        if ($productSetType) {
            $productGroup = $this->productGroupRepository->findByUid($productSetType->getProductGroup());
        }

        $this->view->assignMultiple([
            'productSet'   => $productSet,
            'productGroup' => $productGroup
        ]);
    }

    public function ajaxProductSetAction()
    {
        $getParams = GeneralUtility::_GET();
        $searchString = $getParams['tx_gjotiger']['searchString'];
        $productSets = $this->productSetRepository->findBySearchString($searchString);

        $this->view->assign('searchString', $searchString);
        $this->view->assign('productSets', $productSets);

    }
}