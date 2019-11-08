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
$table = 'tx_gjotiger_domain_model_productsetvariantgroup';

return array(

    'ctrl' => array(
        'title'         => $lll . $table,
        'label'         => 'table_headline',
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

        'product_set_variants' => [
            'label'  => $lll . $table . '.product_set_variants',
            'config' => [
                'type'          => 'inline',
                'foreign_table' => 'tx_gjotiger_domain_model_productsetvariant',
                'foreign_field' => 'product_set_variant_group',
                'maxitems'      => 9999,
                'appearance'    => [
                    'collapseAll'                     => 1,
                    'expandSingle'                    => 1,
                    'levelLinksPosition'              => 'top',
                    'showSynchronizationLink'         => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink'         => 1,
                    'useSortable'                     => true,
                    'enabledControls'                 => [
                        'info'     => true,
                        'new'      => true,
                        'dragdrop' => true,
                        'sort'     => true,
                        'hide'     => true,
                        'delete'   => true,
                        'localize' => true,
                    ],
                ],
            ],
        ],

        'headline' => [
            'label'  => $lll . $table . '.headline',
            'config' => [
                'type' => 'input'
            ]
        ],

        'description' => [
            'label'  => $lll . $table . '.description',
            'config' => [
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 6,
                'enableRichtext' => true
            ],
        ],

        'table_headline' => [
            'label'  => $lll . $table . '.table_headline',
            'config' => [
                'type' => 'input'
            ]
        ],

//        TODO: MM_opposite_field Nutzung prüfen
        'products' => [
            'displayCond' => 'FIELD:sys_language_uid:=:0',
            'exclude' => 0,
            'label'   => $lll . $table . '.products',
            'config'  => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_gjotiger_domain_model_product',
                'foreign_table_where' => 'tx_gjotiger_domain_model_product.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_gjotiger_domain_model_product.name, tx_gjotiger_domain_model_product.article_number, tx_gjotiger_domain_model_product.additional_information ASC',
                'MM_opposite_field'   => 'product_set_variantgroups',
                'MM'                  => 'tx_gjotiger_product_productsetvariantgroup_mm',
                'size'                => 10,
                'autoSizeMax'         => 30,
                'maxitems'            => 9999,
                'multiple'            => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                ],
                'enableMultiSelectFilterTextfield' => TRUE,
            ],
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
            description,
            table_headline,  
            products,

            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            table_headline, 
                            products,
                            product_set_variants,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],

    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);