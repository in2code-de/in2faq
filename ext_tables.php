<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/**
 * Disable non needed fields in tt_content
 */
$TCA['tt_content']['types']['list']['subtypes_excludelist']['in2faq_pi1'] = 'select_key,pages,recursive';

/**
 * Include Plugins
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi1', 'FAQ');

/**
 * Flexform
 */
$pluginSignature = str_replace('_', '', 'in2faq') . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi1.xml'
);
