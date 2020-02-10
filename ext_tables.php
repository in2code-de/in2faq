<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(
    function () {

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
        $TCA['tt_content']['types']['list']['subtypes_addlist']['in2faq_pi1'] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            'in2faq_pi1',
            'FILE:EXT:in2faq/Configuration/FlexForms/FlexFormPi1.xml'
        );

        /**
         * Add TypoScript Static Template
         */
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
            'in2faq',
            'Configuration/TypoScript/',
            'Main TypoScript'
        );
    }
);
