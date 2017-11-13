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
$table = 'tx_gjotiger_domain_model_specificmaterial';
//        tx_gjotiger_domain_model_productspecificmaterial

return array(

    'ctrl' => array(
        'title'         => $lll . $table,
        'label'         => 'name',
        'tstamp'        => 'tstamp',
        'crdate'        => 'crdate',
        'cruser_id'     => 'cruser_id',
        'dividers2tabs' => true,
        'searchFields'  => 'name',
        'iconfile'      => 'EXT:' . $ext . '/Resources/Public/Icons/tiger_icon.png',
        'sortby'        => 'sorting',

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',

        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
    ),

    'columns' => array(

        'name' => array(
            'label'  => $lll . $table . '.name',
            'config' => array(
                'type' => 'input'
            )
        ),

        'description' => array(
            'label'  => $lll . $table . '.description',
            'config' => array(
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 6,
                'enableRichtext' => true
            ),
        ),

        'material_group' => [
            'label'  => $lll . $table . '.material_group',
            'config' => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    ['Holz', 1],
                    ['Glas', 2],
                ],
            ],
        ],

        'material_weight' => array(
            'label'  => $lll . $table . '.material_weight',
            'config' => array(
                'type' => 'input'
            )
        ),

        'image' => array(
            'label'  => $lll . $table . '.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                array(
                    'maxitems' => 1
                ),
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ),

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
            name,
            description,
            material_group,
            material_weight,
            image,
            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                                name,
                                description,
                                material_group,
                                material_weight,
                                image,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],

    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);