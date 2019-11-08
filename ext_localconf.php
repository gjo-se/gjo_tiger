<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'GjoSe.' . $_EXTKEY,
    'Product',
    [
        'Product' => 'showProductGroupTeaser, showProductGroup, showProductSet, ajaxProductSet, productFinder, ajaxListProducts',
    ],
    [
        'Product' => 'showProductGroupTeaser, showProductGroup, showProductSet, ajaxProductSet, productFinder, ajaxListProducts',
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/newContentElement.t3s">'
);
