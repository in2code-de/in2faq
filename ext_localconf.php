<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

call_user_func(
    function () {

        /**
         * Include Frontend Plugins
         */
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2faq',
            'Pi1',
            [
                \In2code\In2faq\Controller\FaqController::class => 'list'
            ],
            [
                \In2code\In2faq\Controller\FaqController::class => 'list'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2faq',
            'Pi2',
            [
                \In2code\In2faq\Controller\FaqController::class => 'filter'
            ],
            [
                \In2code\In2faq\Controller\FaqController::class => 'filter'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2faq',
            'Pi3',
            [
                \In2code\In2faq\Controller\FaqController::class => 'detail'
            ],
            [
                \In2code\In2faq\Controller\FaqController::class => 'detail'
            ]
        );
    }
);
