<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GjoSe.' . $_EXTKEY,
    'Product',
    [
        'Product' => 'showProductGroupTeaser, showProductGroup, showProductSet, ajaxProductSet',
    ],
    [
        'Product' => 'showProductGroupTeaser, showProductGroup, showProductSet, ajaxProductSet',
    ]
);


///* ===========================================================================
//    Add TSconfig
//=========================================================================== */
//
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:news/Configuration/TSconfig/ContentElementWizard.txt">');
