<?php
namespace GjoSe\GjoTiger\Controller;

/***************************************************************
 *  created: 05.09.17 - 14:47
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

use GjoSe\GjoBoilerplate\Controller\AbstractController as GjoBoilerplateAbstractController;
use GjoSe\GjoTiger\Domain\Repository\ProductGroupRepository;
use GjoSe\GjoTiger\Domain\Repository\ProductSetRepository;
use GjoSe\GjoTiger\Domain\Repository\ProductSetTypeRepository;

/**
 * Class AbstractController
 * @package GjoSe\GjoTiger\Controller
 */
abstract class AbstractController extends GjoBoilerplateAbstractController
{
    /**
     * @var \GjoSe\GjoTiger\Domain\Repository\ProductGroupRepository
     */
    protected $productGroupRepository;

    /**
     * @param \GjoSe\GjoTiger\Domain\Repository\ProductGroupRepository
     */
    public function injectProductGroupRepository(ProductGroupRepository $productGroupRepository)
    {
        $this->productGroupRepository = $productGroupRepository;
    }

    /**
     * @var \GjoSe\GjoTiger\Domain\Repository\ProductSetRepository
     */
    protected $productSetRepository;

    /**
     * @param \GjoSe\GjoTiger\Domain\Repository\ProductSetRepository
     */
    public function injectProductSetRepository(ProductSetRepository $productSetRepository)
    {
        $this->productSetRepository = $productSetRepository;
    }

    /**
     * @var \GjoSe\GjoTiger\Domain\Repository\ProductSetTypeRepository
     */
    protected $productSetTypeRepository;

    /**
     * @param \GjoSe\GjoTiger\Domain\Repository\ProductSetTypeRepository
     */
    public function injectProductSetTypeRepository(ProductSetTypeRepository $productSetTypeRepository)
    {
        $this->productSetTypeRepository = $productSetTypeRepository;
    }
}