<?php
defined('TYPO3_MODE') or die();

//TODO: das geht doch bestimmt auch noch besser von der Struktur als in einer Override

call_user_func(function () {

    $ext   = 'gjo_introduction';
    $lll   = 'LLL:EXT:' . $ext . '/Resources/Private/Language/ContentElements.xlf:';

    $defaultCropSettings = \GjoSe\GjoIntroduction\Utility\CroppingUtility::getDefaultCropSettings();

    $mobileCropSettings           = $defaultCropSettings;
    $mobileCropSettings['title']  = $lll . 'cropVariant.mobile';
    $tabletCropSettings           = $defaultCropSettings;
    $tabletCropSettings['title']  = $lll . 'cropVariant.tablet';
    $laptopCropSettings           = $defaultCropSettings;
    $laptopCropSettings['title']  = $lll . 'cropVariant.laptop';
    $desktopCropSettings          = $defaultCropSettings;
    $desktopCropSettings['title'] = $lll . 'cropVariant.desktop';

    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['mobile'] = $mobileCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['tablet'] = $tabletCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['laptop'] = $laptopCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['desktop'] = $desktopCropSettings;

    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image_engineering_drawing']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['mobile'] = $mobileCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image_engineering_drawing']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['tablet'] = $tabletCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image_engineering_drawing']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['laptop'] = $laptopCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['image_engineering_drawing']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['desktop'] = $desktopCropSettings;

    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['icon']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['mobile'] = $mobileCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['icon']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['tablet'] = $tabletCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['icon']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['laptop'] = $laptopCropSettings;
    $GLOBALS['TCA']['tx_gjotiger_domain_model_productset']['columns']['icon']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['desktop'] = $desktopCropSettings;

});
