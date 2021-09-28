<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(
    function () {

        /**
         * Include Frontend Plugins
         */
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2code.in2faq',
            'Pi1',
            [
                'Faq' => 'list'
            ],
            [
                'Faq' => 'list'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2code.in2faq',
            'Pi2',
            [
                'Faq' => 'filter'
            ],
            [
                'Faq' => 'filter'
            ]
        );
    }
);
