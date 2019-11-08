<?php
/***************************************************************
 *  created: 24.08.17 - 13:07
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

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$ext   = 'gjo_tiger';
$lll   = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
$table = 'tx_gjotiger_domain_model_accessorykitgroup';

return array(

    'ctrl' => array(
        'title'         => $lll . $table,
        'label'         => 'headline',
        'tstamp'        => 'tstamp',
        'crdate'        => 'crdate',
        'cruser_id'     => 'cruser_id',
        'dividers2tabs' => true,
        'searchFields'  => 'headline',
        'iconfile'      => 'EXT:' . $ext . '/Resources/Public/Icons/tiger_icon.png',
        'hideTable'     => true,

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',

        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
    ),

    'columns' => array(

        'product_set' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),

        'accessory_kits' => [
            'exclude' => 0,
            'label'   => $lll . $table . '.accessory_kits',
            'config'  => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_gjotiger_domain_model_productset',
                'foreign_table_where' => 'tx_gjotiger_domain_model_productset.is_accessory_kit = 1 ORDER BY name',
                'MM'                  => 'tx_gjotiger_productset_accessorykit_mm',
                'MM_opposite_field'   => 'name',
                'size'                => 10,
                'autoSizeMax'         => 30,
                'maxitems'            => 14,
                'multiple'            => 0
            ],
        ],

        'headline' => [
            'label'  => $lll . $table . '.headline',
            'config' => [
                'type' => 'input'
            ]
        ],

        ###############################################################################

        'sys_language_uid' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config'  => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items'               => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
                'default' => 0,
            ),

        ),
        'l10n_parent'      => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config'      => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => array(
                    array('', 0),
                ),
                'foreign_table'       => $table,
                'foreign_table_where' => 'AND' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.sys_language_uid IN (-1,0)',
                'default' => 0,
            ),

        ),
        'l10n_diffsource'  => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),

        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => array(
                'type' => 'check',
            ),
        ),

    ),

    'interface' => array(
        'showRecordFieldList' => '
            headline,
            accessory_kits,

            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            headline, 
                            accessory_kits,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],

    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);