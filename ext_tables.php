<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'Tiger Products'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GjoSe.' . $_EXTKEY,
    'Product',
    'Tiger Produkte'
);

$quotationPluginSignature = str_replace('_','',$_EXTKEY) . '_product';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$quotationPluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($quotationPluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/product.xml');