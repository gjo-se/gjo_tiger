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
$table = 'tx_gjotiger_domain_model_product';

return array(

    'ctrl' => array(
        'title'           => $lll . $table,
        'label'           => 'name',
        'label_alt'       => 'article_number, additional_information',
        'label_alt_force' => 1,
        'tstamp'          => 'tstamp',
        'crdate'          => 'crdate',
        'cruser_id'       => 'cruser_id',
        'dividers2tabs'   => true,
        'searchFields'    => 'name, article_number',
        'iconfile'        => 'EXT:' . $ext . '/Resources/Public/Icons/tiger_icon.png',
        'default_sortby'  => 'ORDER BY name, article_number, additional_information ASC',

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',

        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
    ),

    'columns' => array(

        'product_sub_group' => array(
            'label'  => $lll . $table . '.product_sub_group',
            'config' => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_gjotiger_domain_model_productsubgroup',
                'foreign_table_where' => 'tx_gjotiger_domain_model_productsubgroup.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_gjotiger_domain_model_productsubgroup.name',
                'items'               => array(
                    array('-- Bitte wählen --', 0)
                ),
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

        'additional_information' => array(
            'label'  => $lll . $table . '.additional_information',
            'config' => array(
                'type' => 'input'
            )
        ),

        //        TODO: Array-Schreibweise umstellen auf []
        //        imageManipulation anpassen - https://docs.typo3.org/typo3cms/TCAReference/ColumnsConfig/Type/ImageManipulation.html
        'image'                  => array(
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
            article_number, 
            additional_information,
            image, 
            product_sub_group,            
            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            product_sub_group,
                            name, 
                            article_number, 
                            additional_information,
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