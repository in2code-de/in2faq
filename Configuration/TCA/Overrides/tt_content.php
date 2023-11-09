<?php

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
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi1', $ll . 'plugin.list_uncached');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi2', $ll . 'plugin.filter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi3', $ll . 'plugin.detail');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi4', $ll . 'plugin.list_cached');

/**
 * Flexform
 */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['in2faq_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'in2faq_pi1',
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi1.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['in2faq_pi2'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'in2faq_pi2',
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi2.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['in2faq_pi4'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'in2faq_pi4',
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi4.xml'
);
