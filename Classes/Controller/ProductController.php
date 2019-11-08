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

        $productSetTypeUid = $this->productSetTypeRepository->findProductSetTypeUidByProductSetUid($this->settings['productSet'], 1);
        $productSetType    = $this->productSetTypeRepository->findByUid($productSetTypeUid);

        $productGroup = null;
        if ($productSetType) {
            $productGroup = $productSetType->getProductGroup();
        }

        $this->view->assignMultiple([
            'productSet'   => $productSet,
            'productGroup' => $productGroup,
            'is_shop'      => GeneralUtility::_GET()['is_shop'],
            'pageUid'      => $GLOBALS['TSFE']->id
        ]);
    }

    public function ajaxProductSetAction()
    {
        $limit        = 0;
        $getParams    = GeneralUtility::_POST();
        $searchString = $getParams['searchString'];
        $productSets  = $this->productSetRepository->findBySearchString($searchString, $limit);

        $productSetsArr = array();

        foreach ($productSets as $productSet) {

            $accessoryKitUids = array();
            $pageUid          = 0;
            if ($productSet->getPages()) {
                $pageUid = $productSet->getPages()->getUid();
            }
            $productSetsArr[$productSet->getUid()] = array(
                'name'    => $productSet->getName(),
                'pageUid' => $pageUid
            );

            $accessorykitGroups    = $productSet->getAccessorykitGroups();
            $accessorykitGroupUids = array();
            if ($accessorykitGroups) {
                foreach ($accessorykitGroups as $accessorykitGroup) {
                    $accessorykitGroupUids[] = $accessorykitGroup->getUid();
                }
            }

            if ($accessorykitGroupUids) {
                $accessorykitUids = array();
                foreach ($accessorykitGroupUids as $accessorykitGroupUid) {
                    $accessorykitUids[] = $this->accessorykitGroupRepository->findAccessorykitUidsByAccessorykitGroupUid($accessorykitGroupUid);
                }
            }

            if ($accessorykitUids) {
                $productSetAccessoryKits = $this->productSetRepository->findAccessoryKitByProductSetAndSearchString($accessorykitUids,
                    $searchString, $limit);

                if ($productSetAccessoryKits) {
                    foreach ($productSetAccessoryKits as $productSetAccessoryKit) {
                        $productSetsArr[$productSet->getUid()]['accessoryKits'][$productSetAccessoryKit->getUid()] = array(
                            'name'   => $productSetAccessoryKit->getName(),
                            'anchor' => $productSetAccessoryKit->getAnchor()
                        );
                    }
                }
            }
        }


        $this->view->assign('searchString', $searchString);
        $this->view->assign('productSetsArr', $productSetsArr);
    }

    public function productFinderAction()
    {
        $this->view->assign('sysLanguageUid', $GLOBALS['TSFE']->sys_language_uid);
    }

    public function ajaxListProductsAction()
    {

        $postParams          = GeneralUtility::_POST();
        $productFinderFilter = $postParams['productFinderFilter'];
        $sysLanguageUid      = $postParams['sysLanguageUid'];

        if ($postParams['offset']) {
            $offset = $postParams['offset'];
        } else {
            $offset = $this->settings['ajaxListProducts']['offset'];
        }

        $productSets      = $this->productSetRepository->findByFilter($sysLanguageUid, $productFinderFilter, $offset,
            $this->settings['ajaxListProducts']['limit']);
        $productSetsCount = $this->productSetRepository->findByFilter($sysLanguageUid, $productFinderFilter)->count();

        $this->view->assign('productSets', $productSets);
        $this->view->assign('productSetsCount', $productSetsCount);
        $this->view->assign('isShop', (int)$postParams['isShop']);
    }

    public function ajaxGetProductSetVariantAction()
    {
        $json = array();

        $postParams                = GeneralUtility::_POST();
        $productSetVariantGroupUid = $postParams['productSetVariantGroupUid'];
        $productSetVariantFilter   = array();

        if ($postParams['productSetVariantFilterTypValueNoFilterTyp']) {
            $productSetVariantFilter['noFilterTyp'] = $postParams['productSetVariantFilterTypValueNoFilterTyp'];
        }

        if ($postParams['productSetVariantFilterTypValueLength']) {
            $productSetVariantFilter['length'] = $postParams['productSetVariantFilterTypValueLength'];
        }

        if ($postParams['productSetVariantFilterTypValueMaterial']) {
            $productSetVariantFilter['material'] = $postParams['productSetVariantFilterTypValueMaterial'];
        }

        if ($postParams['productSetVariantFilterTypValueVersion']) {
            $productSetVariantFilter['version'] = $postParams['productSetVariantFilterTypValueVersion'];
        }

        $productSetVariant = $this->productSetVariantRepository->findByProductSetVariantGroupAndFilter($productSetVariantGroupUid,
            $productSetVariantFilter);

        if ($productSetVariant) {

            $feUserData                 = $GLOBALS['TSFE']->fe_user->user;
            $feUserObj                  = $this->feUserRepository->findByUid($feUserData['uid']);
            $feUserDiscount             = 0;
            $productSetVariantListPrice = $productSetVariant->getPrice() + ($productSetVariant->getPrice() * $productSetVariant->getTax() / 100);

            if ($feUserObj) {
                $feUserGroupsObj = $feUserObj->getUserGroup();

                $discounts = array();
                foreach ($feUserGroupsObj as $feUserGroup) {

                    if ($feUserGroup) {
                        array_push($discounts, $feUserGroup->getTxGjoExtendsFemanagerDiscount());
                    }

                    if (!$feUserGroup->isTxGjoExtendsFemanagerVatIncl()) {
                        $productSetVariantListPrice = $productSetVariant->getPrice();
                    }
                }

                $feUserDiscount = max($discounts);
            }

            $json['productSetVariantUid']           = $productSetVariant->getUid();
            $json['productSetVariantArticleNumber'] = $productSetVariant->getArticleNumber();
        }

        if ($feUserDiscount) {
            $productSetVariantBuyPrice         = $productSetVariantListPrice - ($productSetVariantListPrice * $feUserDiscount / 100);
            $json['productSetVariantBuyPrice'] = number_format($productSetVariantBuyPrice, 2, ',', '.');
        }

        $json['productSetVariantGroupUid']  = $productSetVariantGroupUid;
        $json['productSetVariantListPrice'] = number_format($productSetVariantListPrice, 2, ',', '.');

        return json_encode($json);
    }
}