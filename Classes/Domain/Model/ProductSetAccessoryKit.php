<?php
namespace GjoSe\GjoTiger\Domain\Model;

/***************************************************************
 *  created: 21.10.19 - 08:11
 *  Copyright notice
 *  (c) 2019 Gregory Jo Erdmann <gregory.jo@gjo-se.com>
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

use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class ProductSetAccessoryKit
 * @package GjoSe\GjoTiger\Domain\Model
 */
class ProductSetAccessoryKit extends AbstractModel
{
    /**
     * @var \GjoSe\GjoTiger\Domain\Model\ProductSet
     */
    protected $productSet = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoTiger\Domain\Model\ProductSet>
     * @lazy
     */
    protected $accessoryKits = null;

    /**
     * @var string
     */
    protected $headline = '';

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->accessoryKits = new ObjectStorage();
    }

    /**
     * @return \GjoSe\GjoTiger\Domain\Model\ProductSet
     */
    public function getProductSet()
    {
        return $this->productSet;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return ObjectStorage
     */
    public function getAccessoryKits()
    {
        return $this->accessoryKits;
    }

}