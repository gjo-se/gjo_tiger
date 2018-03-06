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
$table = 'tx_gjotiger_domain_model_productset';

return array(

    'ctrl' => array(
        'title'          => $lll . $table,
        'label'          => 'name',
        'tstamp'         => 'tstamp',
        'crdate'         => 'crdate',
        'cruser_id'      => 'cruser_id',
        'dividers2tabs'  => true,
        'searchFields'   => 'name',
        'iconfile'       => 'EXT:' . $ext . '/Resources/Public/Icons/tiger_icon.png',
        'default_sortby' => 'ORDER BY name ASC',

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',

        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
    ),

    'columns' => array(

        'product_set_variant_groups' => [
            'label'  => $lll . $table . '.product_set_variant_groups',
            'config' => [
                'type'          => 'inline',
                'foreign_table' => 'tx_gjotiger_domain_model_productsetvariantgroup',
                'foreign_field' => 'product_set',
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

        'products' => [
            'exclude' => 0,
            'label'   => $lll . $table . '.products',
            'config'  => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_gjotiger_domain_model_product',
                'foreign_table_where' => 'tx_gjotiger_domain_model_product.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_gjotiger_domain_model_product.name, tx_gjotiger_domain_model_product.article_number, tx_gjotiger_domain_model_product.additional_information ASC',
                'MM_opposite_field'   => 'product_sets',
                'MM'                  => 'tx_gjotiger_product_productset_mm',
                'size'                => 10,
                'autoSizeMax'         => 30,
                'maxitems'            => 9999,
                'multiple'            => 0,
            ],
        ],

        'product_sets' => [
            'exclude' => 0,
            'label'   => $lll . $table . '.product_sets',
            'config'  => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => $table,
                'foreign_table_where' => 'ORDER BY name',
                'MM'                  => 'tx_gjotiger_productset_productset_mm',
                'MM_opposite_field'   => 'name',
                'size'                => 10,
                'autoSizeMax'         => 30,
                'maxitems'            => 9,
                'multiple'            => 0
            ],
        ],

        'pages' => [
            'label'  => $lll . $table . '.pages',
            'config' => [
                'type'          => 'group',
                'internal_type' => 'db',
                'allowed'       => 'pages',
                'size'          => 1,
                'maxitems'      => 1,
                'minitems'      => 0
            ]
        ],

        'name' => array(
            'label'  => $lll . $table . '.name',
            'config' => array(
                'type' => 'input'
            )
        ),

        'is_accessory_kit' => array(
            'label'  => $lll . $table . '.is_accessory_kit',
            'config' => array(
                'type' => 'check',
            ),
        ),

        'is_featured' => array(
            'label'  => $lll . $table . '.is_featured',
            'config' => array(
                'type' => 'check',
            ),
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

        'image' => [
            'label'  => $lll . $table . '.image',
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

        'icon' => [
            'label'  => $lll . $table . '.icon',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'icon',
                [
                    'maxitems'         => 1,
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


        'show_technicalnots' => [
            'label'    => $lll . $table . '.show_technicalnots',
            'config'   => [
                'type' => 'check',
            ],
            'onChange' => 'reload',
        ],

        'minimum_door_weight' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_weight',
            'config'      => [
                'type' => 'input',

            ]
        ],

        'maximum_door_weight' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.maximum_door_weight',
            'config'      => [
                'type' => 'input',

            ]
        ],

        'height' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.height',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_thickness' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_thickness',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'maximum_door_thickness' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.maximum_door_thickness',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'maximum_door_width' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.maximum_door_width',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width_soft_close' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width_soft_close',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width_soft_close_long' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width_soft_close_long',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width_soft_close_both' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width_soft_close_both',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'voltage' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.voltage',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'show_din' => [
            'label'    => $lll . $table . '.show_din',
            'config'   => [
                'type' => 'check',
            ],
            'onChange' => 'reload',
        ],

        'use_categorie' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.use_categorie',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'durability' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.durability',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'door_weight' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.door_weight',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'fire_resistance' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.fire_resistance',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'safety' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.safety',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'corrosion_resistance' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.corrosion_resistance',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'security' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.security',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'door_type' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.door_type',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'initial_friction' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.initial_friction',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'invitation_to_tender' => [
            'label'  => $lll . $table . '.invitation_to_tender',
            'config' => [
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 6,
                'enableRichtext' => true
            ],
        ],

        'download' => [
            'label'  => $lll . $table . '.download',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'download',
                [
                    'maxitems' => 99
                ],
                'pdf, dwg, dxf'
            ),
        ],

        'download_engineering_drawing' => [
            'label'  => $lll . $table . '.download_engineering_drawing',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'download_engineering_drawing',
                [
                    'maxitems' => 99
                ],
                'pdf, dwg, dxf'
            ),
        ],

        'image_engineering_drawing' => [
            'label'  => $lll . $table . '.image_engineering_drawing',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image_engineering_drawing',
                [
                    'maxitems'         => 10,
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

        'filter_montage_ahead' => [
            'label'  => $lll . $table . '.filter_montage_ahead',
            'config' => [
                'type' => 'check'
            ]
        ],

        'filter_montage_in' => [
            'label'  => $lll . $table . '.filter_montage_in',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_montage_wall' => [
            'label'  => $lll . $table . '.filter_montage_wall',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_montage_ceiling' => [
            'label'  => $lll . $table . '.filter_montage_ceiling',
            'config' => [
                'type' => 'check',
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

        'filter_material_wood' => [
            'label'  => $lll . $table . '.filter_material_wood',
            'config' => [
                'type' => 'check'
            ]
        ],

        'filter_material_glas' => [
            'label'  => $lll . $table . '.filter_material_glas',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_wingcount' => [
            'label'  => $lll . $table . '.filter_wingcount',
            'config' => [
                'type'       => 'select',
                'renderType' => 'selectSingleBox',
                'items'      => [
                    ['1-flügelig', 1],
                    ['2-flügelig', 2],
                    ['3-flügelig', 3]
                ],
            ],
        ],

        'filter_design_customer' => [
            'label'  => $lll . $table . '.filter_design_customer',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_design_alu' => [
            'label'  => $lll . $table . '.filter_design_alu',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_design_design' => [
            'label'  => $lll . $table . '.filter_design_design',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_soft_close' => [
            'label'  => $lll . $table . '.filter_soft_close',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_et3' => [
            'label'  => $lll . $table . '.filter_et3',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_tfold' => [
            'label'  => $lll . $table . '.filter_tfold',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_synchron' => [
            'label'  => $lll . $table . '.filter_synchron',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_telescop2' => [
            'label'  => $lll . $table . '.filter_telescop2',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_telescop3' => [
            'label'  => $lll . $table . '.filter_telescop3',
            'config' => [
                'type' => 'check',
            ],
        ],

    ),

    'interface' => array(
        'showRecordFieldList' => '
              name,
              is_accessory_kit,
              is_featured,
              description,
              image,
              icon,
              minimum_door_weight,
              maximum_door_weight,
              height,
              door_leaf_thickness,
              minimum_door_width,
              maximum_door_width,
              minimum_door_width_soft_close,
              minimum_door_width_soft_close_long,
              minimum_door_width_soft_close_both,
              voltage,
              use_categorie,
              durability,
              door_weight,
              fire_resistance,
              safety,
              corrosion_resistance,
              security,
              door_type,
              initial_friction,
              invitation_to_tender,
              download,
              download_engineering_drawing,
              image_engineering_drawing,
              product_sets,
              filter_material_wood,
              filter_material_glas,
              filter_wingcount,
              filter_montage_ahead,
              filter_montage_in,
              filter_montage_wall,
              filter_montage_ceiling,
              filter_design_customer,
              filter_design_alu,
              filter_design_design,
              filter_soft_close,
              filter_et3,
              filter_tfold,
              filter_synchron,
              filter_telescop2,
              filter_telescop3,
              
            
              product_set_variant_groups,
              products,    
              pages,
            sys_language_uid,
            hide
            '
    ),

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                              name,
                              is_accessory_kit,
                              is_featured,
                              description,                                                            
                              image,
                              icon,
                              pages,
                        --div--;' . $lll . $table . '.tabs.products,  
                              products,
                              product_set_variant_groups,
                        --div--;' . $lll . $table . '.tabs.technicalNotes,
                              show_technicalnots,
                              minimum_door_weight,
                              maximum_door_weight,
                              height,
                              door_leaf_thickness,
                              maximum_door_width,
                              minimum_door_width,
                              minimum_door_width_soft_close,
                              minimum_door_width_soft_close_long,
                              minimum_door_width_soft_close_both,
                              voltage,
                        --div--;' . $lll . $table . '.tabs.dinEn1527,
                              show_din,
                              use_categorie,
                              durability,
                              door_weight,
                              fire_resistance,
                              safety,
                              corrosion_resistance,
                              security,
                              door_type,
                              initial_friction,
                        --div--;' . $lll . $table . '.tabs.invitation_to_tender,
                              invitation_to_tender,
                        --div--;' . $lll . $table . '.tabs.downloads,
                              download,  
                              download_engineering_drawing,
                              image_engineering_drawing,
                        --div--;' . $lll . $table . '.tabs.accessory_kit,
                              product_sets,
                        --div--;' . $lll . $table . '.tabs.filter,
                              --palette--;' . $lll . $table . '.palettes.material;material,
                              filter_wingcount,
                              --palette--;' . $lll . $table . '.palettes.design;design,
                              --palette--;' . $lll . $table . '.palettes.configuration;configuration,
                              --palette--;' . $lll . $table . '.palettes.montage;montage,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],

    'palettes' => array(
        'material'      => array(
            'showitem' => '
                filter_material_wood,
                filter_material_glas
        '
        ),
        'design'        => array(
            'showitem' => '
                filter_design_customer,
                filter_design_alu,
                filter_design_design
      
         '
        ),
        'configuration' => array(
            'showitem' => '
                  filter_soft_close,
                  filter_et3,
                  filter_tfold,
                  filter_synchron,
                  filter_telescop2,
                  filter_telescop3
        '
        ),
        'montage'       => array(
            'showitem' => '
                filter_montage_ahead,
                filter_montage_in,
                filter_montage_wall,
                filter_montage_ceiling,
        '
        ),
    ),

);