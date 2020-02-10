<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(
    function () {

        /**
         * Include Frontend Plugins for In2etb
         */
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2code.in2faq',
            'Pi1',
            [
                'Faq' => 'list, notice'
            ],
            [
                'Faq' => ''
            ]
        );

        /**
         * CommandController for importer tasks
         */
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
            \In2code\In2faq\Command\ImportFromIrfaqCommandController::class;
    }
);
