<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die;

$ll = 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:';

/**
 * Disable non needed fields in tt_content
 */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2faq_pi1']
    = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2faq_pi2']
    = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2faq_pi3']
    = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2faq_pi4']
    = 'select_key,pages,recursive';
/**
 * Include Plugins
 */
$pluginSignaturePi1 = ExtensionUtility::registerPlugin('in2faq', 'Pi1', $ll . 'plugin.list_uncached');
$pluginSignaturePi2 = ExtensionUtility::registerPlugin('in2faq', 'Pi2', $ll . 'plugin.filter');
$pluginSignaturePi3 = ExtensionUtility::registerPlugin('in2faq', 'Pi3', $ll . 'plugin.detail');
$pluginSignaturePi4 = ExtensionUtility::registerPlugin('in2faq', 'Pi4', $ll . 'plugin.list_cached');

/**
 * Flexform
 */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignaturePi1] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignaturePi1,
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi1.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignaturePi2] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignaturePi2,
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi2.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignaturePi3] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignaturePi3,
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi3.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignaturePi4] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignaturePi4,
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi4.xml'
);
