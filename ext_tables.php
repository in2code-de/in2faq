<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

call_user_func(
    function () {

        $ll = 'LLL:EXT:in2faq/Resources/Private/Language/locallang_db.xlf:';
        /**
         * Disable non needed fields in tt_content
         */
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2faq_pi1']
            = 'select_key,pages,recursive';

        /**
         * Include Plugins
         */
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi1', $ll . 'plugin.list_uncached');
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi2', $ll . 'plugin.filter');
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('in2faq', 'Pi3', $ll . 'plugin.detail');

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
