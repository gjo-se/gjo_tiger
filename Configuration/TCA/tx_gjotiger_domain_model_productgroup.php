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
$table = 'tx_gjotiger_domain_model_productgroup';

return array(

    'ctrl' => array(
        'title'          => $lll . $table,
        'label'          => 'header',
        'tstamp'         => 'tstamp',
        'crdate'         => 'crdate',
        'cruser_id'      => 'cruser_id',
        'dividers2tabs'  => true,
        'searchFields'   => 'header',
        'iconfile'       => 'EXT:' . $ext . '/Resources/Public/Icons/tiger_icon.png',
        'default_sortby' => 'ORDER BY header ASC',

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',

        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
    ),

    'columns' => array(

        'product_set_types' => array(
            'label'  => $lll . $table . '.product_set_types',
            'config' => array(
                'type'          => 'inline',
                'foreign_table' => 'tx_gjotiger_domain_model_productsettype',
                'foreign_field' => 'product_group',
                'maxitems'      => 9999,
                'appearance'    => array(
                    'collapseAll'                     => 1,
                    'expandSingle'                    => 1,
                    'levelLinksPosition'              => 'top',
                    'showSynchronizationLink'         => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink'         => 1,
                    'useSortable'                     => true,
                    'enabledControls'                 => array(
                        'info'     => true,
                        'new'      => true,
                        'dragdrop' => true,
                        'sort'     => true,
                        'hide'     => true,
                        'delete'   => true,
                        'localize' => true,
                    ),
                ),
            ),

        ),

        'pages' => [
            'label'  => $lll . $table . '.pages',
            'config' => [
                'type'          => 'group',
                'internal_type' => 'db',
                'allowed'       => 'pages',
                'size'          => 1,
                'maxitems'      => 1,
                'minitems'      => 1
            ]
        ],

        'header' => array(
            'label'  => $lll . $table . '.header',
            'config' => array(
                'type' => 'input'
            )
        ),

        'sub_header' => array(
            'label'  => $lll . $table . '.sub_header',
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
                'enableRichtext' => true,
            ),
        ),

        'image' => [
            'label'  => 'BilderImage', //$lll . $table . '.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'maxitems'         => 2,
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                            --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                            --palette--;;filePalette'
                            ],
                        ],
                    ],

                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],

        'teaser_header' => array(
            'label'  => $lll . $table . '.teaser_header',
            'config' => array(
                'type' => 'input'
            )
        ),

        'teaser_description' => array(
            'label'  => $lll . $table . '.teaser_description',
            'config' => array(
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 6,
                'enableRichtext' => true
            ),
        ),

        'teaser_image' => array(
            'label'  => $lll . $table . '.teaser_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'teaser_image',
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
            header,
            sub_header,
            description,
            image,
            pages,
            teaser_header,
            teaser_description,
            teaser_image,
            product_set_types,

            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem'         => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            header,
                            sub_header,
                            description,
                            image,
                            pages,
                        --div--;' . $lll . $table . '.teaser,
                            teaser_header,
                            teaser_description,
                            teaser_image,
                        --div--;' . $lll . $table . '.product_set_type,
                            product_set_types,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ],
    ],

    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);