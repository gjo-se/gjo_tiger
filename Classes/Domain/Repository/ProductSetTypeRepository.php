<?php
namespace GjoSe\GjoTiger\Domain\Repository;

/***************************************************************
 *  created: 04.09.17 - 15:40
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

/**
 * Class ProductSetTypeRepository
 * @package GjoSe\GjoTiger\Domain\Repository
 */
class ProductSetTypeRepository extends AbstractRepository
{
    // TODO: Verwenung prüfen!
//    public function findByProductSet($productSet)
//    {
//        $query = $this->createQuery();
//        $query->matching(
//            $query->logicalOr([
//                $query->equals('author.tags.name', 'typo3'),
//                $query->equals('author.tagsSpecial.name', 'typo3')
//            ])
//        );
//        $posts = $query->execute();
//    }

    /**
     * @return array
     */
    public function findProductSetTypeUidByProductSetUid($productSetUid, $maxCount = '')
    {
        $rows = $this->db->exec_SELECTgetRows(
            'uid_foreign',
            'tx_gjotiger_productset_productsettype_mm',
            'uid_local=' . $productSetUid,
            '',
            '',
            $maxCount
        );

        $productSetTypeUid = null;

        if(count($rows)){
            $productSetTypeUid = $rows[0]['uid_foreign'];
        }

        return $productSetTypeUid;
    }
}