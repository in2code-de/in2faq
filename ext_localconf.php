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

        /**
         * CommandController for importer tasks
         */
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
            \In2code\In2faq\Command\ImportFromIrfaqCommandController::class;
    }
);
