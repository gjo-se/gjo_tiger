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
$table = 'tx_gjotiger_domain_model_productsetvariant';

return array(

    'ctrl' => array(
        'title'           => $lll . $table,
        'label'           => 'name',
        'tstamp'          => 'tstamp',
        'crdate'          => 'crdate',
        'cruser_id'       => 'cruser_id',
        'dividers2tabs'   => true,
        'searchFields'    => 'name, article_number',
        'iconfile'        => 'EXT:' . $ext . '/Resources/Public/Icons/tiger_icon.png',
        'hideTable'        => true,

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',

        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
    ),

    'columns' => array(

        'product_set_variant_group' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),

        'name' => array(
            'label'  => $lll . $table . '.name',
            'config' => array(
                'type' => 'input'
            )
        ),

        'article_number' => array(
            'label'  => $lll . $table . '.article_number',
            'config' => array(
                'type' => 'input'
            )
        ),

        'price' => [
            'label'  => $lll . $table . '.price',
            'config' => [
                'type' => 'input',
                'eval' => 'double2'
            ]
        ],

        'tax' => [
            'label'  => $lll . $table . '.tax',
            'config' => [
                'type' => 'input',
                'default' => 0,
            ]
        ],

        'material' => [
            'label'  => $lll . $table . '.material',
            'config'      => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => array(
                    array('---', '0'),
                    array('ALU', 'alu'),
                    array('EV1', 'ev1'),
                    array('C31', 'c31'),
                    array('schwarz', 'black'),
                    array('silber', 'silver'),
                    array('weiß', 'white')
                ),
                'default' => 0,
            ),

        ],

        'length' => [
            'label'  => $lll . $table . '.length',
            'config' => [
                'type' => 'input',
                'default' => 0,
            ]
        ],

        'version' => [
            'label'  => $lll . $table . '.version',
            'config' => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => array(
                    array('---', '0'),
                    array('---ET3-Zubehör---', '---'),
                    array('1-Kanal', '1-Channel'),
                    array('4-Kanal', '4-Channel'),
                    array('CleanSwitch', 'cleanSwitch'),
                    array('Push Plate', 'pushPlate'),
                    array('Taster', 'button'),
                    array('---DÄMPFUNG---', '---'),
                    array('einseitig', 'one-sided'),
                    array('einseitig kurz', 'one-side-short'),
                    array('einseitig lang', 'one-side-long'),
                    array('zweiseitig', 'two-sided'),
                    array('---WANDWINKEL---', '---'),
                    array('fest', 'fix'),
                    array('verstellbar', 'adjustable'),
                    array('---ENDKAPPEN FÜR---', '---'),
                    array('Holz', 'wood'),
                    array('Holz MX', 'wood_mx'),
                    array('Glas', 'glass'),
                    array('ET3 Holz', 'et3_wood'),
                    array('ET3 Glas', 'et3_glass'),
                    array('---Sonstiges---', '---'),
                    array('MX', 'mx'),
                    array('System-Set', 'system-set'),
                    array('Ergänzungs-Set', 'accessoryKit'),
                    array('Kartongarnitur', 'boxed-set'),

                ),
                'default' => 0,
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
            name, 
            article_number, 
            price,
            tax,

            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            name, 
                            article_number, 
                            material,
                            length,
                            version,
                        --div--;' . $lll . $table . '.tabs.price, 
                            price,
                            tax, 
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],

    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);