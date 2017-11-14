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

    public function findBySearchString($searchString = '')
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
              ->setRespectStoragePage(false);

        $query->matching(
            $query->logicalAnd(
                $query->logicalOr(
                    $query->like('name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.productSetVariants.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.productSetVariants.articleNumber', '%' . $searchString . '%'),
                    $query->like('products.name', '%' . $searchString . '%'),
                    $query->like('products.articleNumber', '%' . $searchString . '%')
                ),
                $query->equals('is_accessory_kit', 0)
            )

        );

        $query->setOrderings(
            array(
                'is_featured' => QueryInterface::ORDER_DESCENDING,
                'name' => QueryInterface::ORDER_ASCENDING
            )
        );

        return $query->execute();
    }

    public function findByFilter($productFinderFilter = '', $offset = 0, $limit = 0)
    {

        $pluginSignature = 'tx_gjotiger_product[';
        $query = $this->createQuery();

//        https://docs.typo3.org/typo3cms/ExtbaseFluidBook/6-Persistence/3-implement-individual-database-queries.html
        $constraints = array();
        $constraints[] = $query->equals('is_accessory_kit', 0);

        if($productFinderFilter){

            if (isset($productFinderFilter[$pluginSignature . 'material'])) {
                if($productFinderFilter[$pluginSignature . 'material'] == 'wood'){
                    $constraints[] = $query->equals('filterMaterialWood', 1);
                }
                if ($productFinderFilter[$pluginSignature . 'material'] == 'glas') {
                    $constraints[] = $query->equals('filterMaterialGlas', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'wingCount'])) {
                $constraints[] = $query->like('filterWingcount', '%' . $productFinderFilter[$pluginSignature . 'wingCount'] . '%');
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWidth'])) {
                $constraints[] = $query->lessThanOrEqual('minimumDoorWidth', intval($productFinderFilter[$pluginSignature . 'doorWidth']));
                $constraints[] = $query->greaterThanOrEqual('maximumDoorWidth', $productFinderFilter[$pluginSignature . 'doorWidth']);
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorThickness'])) {
                $constraints[] = $query->lessThanOrEqual('minimumDoorThickness', intval($productFinderFilter[$pluginSignature . 'doorThickness']));
                $constraints[] = $query->greaterThanOrEqual('maximumDoorThickness', $productFinderFilter[$pluginSignature . 'doorThickness']);
            }
            if (isset($productFinderFilter[$pluginSignature . 'doorWeight'])) {
                $constraints[] = $query->lessThanOrEqual('minimumDoorWeight', intval($productFinderFilter[$pluginSignature . 'doorWeight']));
                $constraints[] = $query->greaterThanOrEqual('maximumDoorWeight', $productFinderFilter[$pluginSignature . 'doorWeight']);
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
                'name' => QueryInterface::ORDER_ASCENDING
            )
        );

        return $query->execute();
    }
}