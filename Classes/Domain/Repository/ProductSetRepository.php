<?php

namespace GjoSe\GjoTiger\Domain\Repository;

/***************************************************************
 *  created: 04.09.17 - 15:37
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

use GjoSe\GjoBoilerplate\Domain\Repository\AbstractRepository as GjoBoilerplateAbstractRepository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class ProductSetRepository
 * @package GjoSe\GjoTiger\Domain\Repository
 */
class ProductSetRepository extends AbstractRepository
{

    public function findBySearchString($searchString = '', $limit = 0)
    {
        $GLOBALS['TYPO3_DB']->quoteStr($searchString, 'tx_gjotiger_domain_model_productset');

        $query = $this->createQuery();
        $query->getQuerySettings()
              ->setRespectStoragePage(false);

        $searchStringForName = array();
        $searchStringArr = explode(' ', $searchString);
        foreach ($searchStringArr as $searchStringArrVal) {
            $searchStringForName[] = $query->like('name', '%' . $searchStringArrVal . '%');
        }

        $query->matching(
            $query->logicalAnd(
                $query->logicalOr(
                    $query->logicalAnd($searchStringForName),
                    $query->like('productSetVariantGroups.productSetVariants.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.productSetVariants.articleNumber', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.articleNumber', '%' . $searchString . '%'),
                    $query->like('accessorykitGroups.accessoryKits.productSetVariantGroups.products.name', '%' . $searchString . '%'),
                    $query->like('accessorykitGroups.accessoryKits.productSetVariantGroups.products.articleNumber', '%' . $searchString . '%')
                ),
                $query->equals('is_accessory_kit', 0)
            )

        );

        $query->setOrderings(
            array(
                'is_featured' => QueryInterface::ORDER_DESCENDING,
                'name'        => QueryInterface::ORDER_ASCENDING
            )
        );

        if ($limit) {
            $query->setLimit(intval($limit));
        }

        $sysLanguageUid = $GLOBALS['TSFE']->sys_language_uid;
        $query->getQuerySettings()->setLanguageUid($sysLanguageUid);

        return $query->execute();
    }


    public function findAccessoryKitByProductSetAndSearchString($accessoryKitUidList, $searchString, $limit)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
              ->setRespectStoragePage(false);

        $query->matching(
            $query->logicalAnd(
                $query->equals('is_accessory_kit', 1),
                $query->in('uid', $accessoryKitUidList),
                $query->logicalOr(
                    $query->like('productSetVariantGroups.products.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.articleNumber', '%' . $searchString . '%')
                )
            )

        );

        $query->setOrderings(
            array(
                'productSetVariantGroups.products.name'        => QueryInterface::ORDER_ASCENDING
            )
        );

        if ($limit) {
            $query->setLimit(intval($limit));
        }

        $sysLanguageUid = $GLOBALS['TSFE']->sys_language_uid;
        $query->getQuerySettings()->setLanguageUid($sysLanguageUid);

        return $query->execute();
    }

    public function findByFilter($sysLanguageUid, $productFinderFilter = '', $offset = 0, $limit = 0)
    {

        $pluginSignature = 'tx_gjotiger_product[';
        $query           = $this->createQuery();

        //        https://docs.typo3.org/typo3cms/ExtbaseFluidBook/6-Persistence/3-implement-individual-database-queries.html
        $constraints   = array();
        $constraints[] = $query->equals('is_accessory_kit', 0);

        //TODO: Benutzung klären!
        $constraintsNotFoundHelper = $query->equals('name', 'IsNotFound');

        if ($productFinderFilter) {

            if (isset($productFinderFilter[$pluginSignature . 'wood'])) {
                if ($productFinderFilter[$pluginSignature . 'wood'] == '1') {
                    $constraints[] = $query->equals('filterMaterialWood', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'glass'])) {
                if ($productFinderFilter[$pluginSignature . 'glass'] == '1') {
                    $constraints[] = $query->equals('filterMaterialGlas', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'wingCount'])) {
                if ($productFinderFilter[$pluginSignature . 'wingCount']) {
                    $constraints[] = $query->like('filterWingcount', '%' . $productFinderFilter[$pluginSignature . 'wingCount'] . '%');
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWidth'])) {
                if ($productFinderFilter[$pluginSignature . 'doorWidth']) {
                    $constraints[] = $query->lessThanOrEqual('minimumDoorWidth',
                        intval($productFinderFilter[$pluginSignature . 'doorWidth']));
                    $constraints[] = $query->greaterThanOrEqual('maximumDoorWidth', $productFinderFilter[$pluginSignature . 'doorWidth']);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorThickness'])) {
                if ($productFinderFilter[$pluginSignature . 'doorThickness']) {
                    $constraints[] = $query->lessThanOrEqual('minimumDoorThickness',
                        intval($productFinderFilter[$pluginSignature . 'doorThickness']));
                    $constraints[] = $query->greaterThanOrEqual('maximumDoorThickness',
                        $productFinderFilter[$pluginSignature . 'doorThickness']);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWeight'])) {
                if ($productFinderFilter[$pluginSignature . 'doorWeight']) {
                    $constraints[] = $query->lessThanOrEqual('minimumDoorWeight',
                        intval($productFinderFilter[$pluginSignature . 'doorWeight']));
                    $constraints[] = $query->greaterThanOrEqual('maximumDoorWeight', $productFinderFilter[$pluginSignature . 'doorWeight']);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'customer'])) {
                if ($productFinderFilter[$pluginSignature . 'customer'] == '1') {
                    $constraints[] = $query->equals('filterDesignCustomer', 1);
                }
            }

//            3x dersekbe Code?!
//            if (isset($productFinderFilter[$pluginSignature . 'customer'])) {
//                if ($productFinderFilter[$pluginSignature . 'customer'] == '1') {
//                    $constraints[] = $query->equals('filterDesignCustomer', 1);
//                }
//            }
//
//            if (isset($productFinderFilter[$pluginSignature . 'customer'])) {
//                if ($productFinderFilter[$pluginSignature . 'customer'] == '1') {
//                    $constraints[] = $query->equals('filterDesignCustomer', 1);
//                }
//            }

            if (isset($productFinderFilter[$pluginSignature . 'alu'])) {
                if ($productFinderFilter[$pluginSignature . 'alu'] == '1') {
                    $constraints[] = $query->equals('filterDesignAlu', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'design'])) {
                if ($productFinderFilter[$pluginSignature . 'design'] == '1') {
                    $constraints[] = $query->equals('filterDesignDesign', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'soft-close'])) {
                if ($productFinderFilter[$pluginSignature . 'soft-close'] == '1') {

                    $constraintsFilterSoftClose = $query->equals('filterSoftClose', 1);

                    if ($productFinderFilter[$pluginSignature . 'doorWidth']) {
                        $constraintsMinimumDoorWidth = $query->lessThanOrEqual('minimumDoorWidthSoftClose', intval($productFinderFilter[$pluginSignature . 'doorWidth']));
                    }else{
                        $constraintsMinimumDoorWidth = $query->lessThanOrEqual('minimumDoorWidthSoftClose', 9999);
                    }

                    $constraintsAlu80SoftClose = $query->equals('filterSoftClose', 1);
                    if ($productFinderFilter[$pluginSignature . 'telescop2'] == $this->settings['productset']['alu-80']['softClose']['telescop2']) {
                        $constraintsAlu80SoftClose = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'telescop3'] == $this->settings['productset']['alu-80']['softClose']['telescop3']) {
                        $constraintsAlu80SoftClose = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }

                    $constraints[] = $query->logicalAnd(
                        $constraintsFilterSoftClose,
                        $constraintsAlu80SoftClose,
                        $constraintsMinimumDoorWidth
                    );
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'et3'])) {
                if ($productFinderFilter[$pluginSignature . 'et3'] == '1') {
                    $constraints[] = $query->equals('filterEt3', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 't-fold'])) {
                if ($productFinderFilter[$pluginSignature . 't-fold'] == '1') {
                    $constraints[] = $query->equals('filterTfold', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'synchron'])) {
                if ($productFinderFilter[$pluginSignature . 'synchron'] == '1') {

                    $constraintsAlu80Syncron = $query->equals('filterSynchron', 1);
                    if ($productFinderFilter[$pluginSignature . 'doorWidth'] > $this->settings['productset']['alu-80']['synchron']['maximumDoorWidth']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'soft-close'] == $this->settings['productset']['alu-80']['synchron']['softClose']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'telescop2'] == $this->settings['productset']['alu-80']['synchron']['telescop2']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'telescop3'] == $this->settings['productset']['alu-80']['synchron']['telescop3']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }

                    $constraintsAlu250Syncron = $query->equals('filterSynchron', 1);
                    if ($productFinderFilter[$pluginSignature . 'doorWeight'] > $this->settings['productset']['alu-250']['synchron']['maximumDoorWeight']) {
                        $constraintsAlu250Syncron = $query->logicalNot(
                            $query->like('name', '%Alu 250%')
                        );
                    }

                    $constraints[] = $query->logicalAnd(
                        $query->equals('filterSynchron', 1),
                        $constraintsAlu80Syncron,
                        $constraintsAlu250Syncron
                    );
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'telescop2'])) {
                if ($productFinderFilter[$pluginSignature . 'telescop2']) {

                    $constraintsAlu80Telescop2 = $query->equals('filterTelescop2', 1);

                    $doorWidth        = $productFinderFilter[$pluginSignature . 'doorWidth'];
                    $minimumDoorWidth = $this->settings['productset']['alu-80']['telescop2']['minimumDoorWidth'];
                    $maximumDoorWidth = $this->settings['productset']['alu-80']['telescop2']['maximumDoorWidth'];

                    $doorThickness        = $productFinderFilter[$pluginSignature . 'doorThickness'];
                    $minimumDoorThickness = $this->settings['productset']['alu-80']['telescop2']['minimumDoorThickness'];
                    $maximumDoorThickness = $this->settings['productset']['alu-80']['telescop2']['maximumDoorThickness'];

                    if (($doorWidth > 0 && $doorWidth < $minimumDoorWidth) OR
                        ($doorWidth > 0 && $doorWidth > $maximumDoorWidth) OR
                        ($doorThickness > 0 && $doorThickness < $minimumDoorThickness) OR
                        ($doorThickness > 0 && $doorThickness > $maximumDoorThickness)
                    ) {

                        $constraintsAlu80Telescop2 = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }

                    $constraints[] = $query->logicalAnd(
                        $query->equals('filterTelescop2', 1),
                        $constraintsAlu80Telescop2
                    );
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'telescop3'])) {
                if ($productFinderFilter[$pluginSignature . 'telescop3']) {

                    $constraintsAlu80Telescop3 = $query->equals('filterTelescop3', 1);

                    $doorWidth        = $productFinderFilter[$pluginSignature . 'doorWidth'];
                    $minimumDoorWidth = $this->settings['productset']['alu-80']['telescop3']['minimumDoorWidth'];
                    $maximumDoorWidth = $this->settings['productset']['alu-80']['telescop3']['maximumDoorWidth'];

                    $doorThickness        = $productFinderFilter[$pluginSignature . 'doorThickness'];
                    $minimumDoorThickness = $this->settings['productset']['alu-80']['telescop3']['minimumDoorThickness'];
                    $maximumDoorThickness = $this->settings['productset']['alu-80']['telescop3']['maximumDoorThickness'];

                    $doorWeight        = $productFinderFilter[$pluginSignature . 'doorWeight'];
                    $maximumDoorWeight = $this->settings['productset']['alu-80']['telescop3']['maximumDoorWeight'];

                    if (($doorWidth > 0 && $doorWidth < $minimumDoorWidth) OR
                        ($doorWidth > 0 && $doorWidth > $maximumDoorWidth) OR
                        ($doorThickness > 0 && $doorThickness < $minimumDoorThickness) OR
                        ($doorThickness > 0 && $doorThickness > $maximumDoorThickness) OR
                        ($doorWeight > 0 && $doorWeight > $maximumDoorWeight)
                    ) {
                        $constraintsAlu80Telescop3 = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }

                    $constraints[] = $query->logicalAnd(
                        $query->equals('filterTelescop3', 1),
                        $constraintsAlu80Telescop3
                    );
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 't-close'])) {
                if ($productFinderFilter[$pluginSignature . 't-close'] == '1') {
                    $constraints[] = $query->equals('filterTclose', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 't-master'])) {
                if ($productFinderFilter[$pluginSignature . 't-master'] == '1') {
                    $constraints[] = $query->equals('filterTmaster', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-wall'])) {
                if ($productFinderFilter[$pluginSignature . 'montage-wall'] == '1') {
                    $constraints[] = $query->equals('filterMontageWall', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-ceiling'])) {
                if ($productFinderFilter[$pluginSignature . 'montage-ceiling'] == '1') {
                    $constraints[] = $query->equals('filterMontageCeiling', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-in-wall'])) {
                if ($productFinderFilter[$pluginSignature . 'montage-in-wall'] == '1') {
                    $constraints[] = $query->equals('filterMontageIn', 1);
                }
            }

        }

        $query->matching($query->logicalAnd($constraints));

        if ($offset) {
            $query->setOffset(intval($offset));
        }
        if ($limit) {
            $query->setLimit(intval($limit));
        }

        $query->setOrderings(
            array(
                'is_featured' => QueryInterface::ORDER_DESCENDING,
                'name'        => QueryInterface::ORDER_ASCENDING
            )
        );

        $query->getQuerySettings()->setLanguageUid($sysLanguageUid);

        return $query->execute();
    }

    public
    function findAllWithVariants()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
              ->setRespectStoragePage(false);

        $query->setOrderings(
            array(
                'name' => QueryInterface::ORDER_ASCENDING
            )
        );

        $queryResult = $query->execute();

        if ($queryResult->count()) {

            $productSetWithVariants = array();
            foreach ($queryResult as $productSet) {

                $productSetVariantGroups = $productSet->getProductSetVariantGroups();
                if ($productSetVariantGroups) {
                    foreach ($productSetVariantGroups as $productSetVariantGroup) {
                        $productSetVariants = $productSetVariantGroup->getProductSetVariants();

                        if ($productSetVariants) {
                            foreach ($productSetVariants as $productSetVariant) {
                                $productSetWithVariants [$productSetVariant->getArticleNumber()] = $productSet->getName() . ' - ' . $productSetVariantGroup->getTableHeadline() . ' - ' . $productSetVariant->getName();
                            }
                        }
                    }
                }
            }
        }

        return $productSetWithVariants;
    }
}