<?php
declare(strict_types=1);
namespace In2code\In2faq\Utility;

use TYPO3\CMS\Core\Routing\PageArguments;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Class FrontendUtility
 */
class FrontendUtility
{
    /**
     * Because GET params can be rewritten via routing configuration and so only available via TSFE on the one hand
     * and on the other hand some POST params are still available when a form is submitted, we need a function that
     * merges both sources
     *
     * @param string $key
     * @return array
     */
    public static function getArguments(string $key = 'tx_in2faq_pi1'): array
    {
        return array_merge(
            self::getArgumentsFromTyposcriptFrontendController($key),
            self::getArgumentsFromGetOrPostRequest($key)
        );
    }

    /**
     * @param string $key
     * @return array
     */
    protected static function getArgumentsFromGetOrPostRequest(string $key): array
    {
        return (array)GeneralUtility::_GP($key);
    }

    /**
     * @param string $key
     * @return array
     */
    protected static function getArgumentsFromTyposcriptFrontendController(string $key): array
    {
        $typoScriptFrontend = self::getTyposcriptFrontendController();
        if ($typoScriptFrontend !== null) {
            $pageArguments = $typoScriptFrontend->getPageArguments();
            $arguments = $pageArguments->getArguments();
            if (array_key_exists($key, $arguments)) {
                return (array)$arguments[$key];
            }
        }
        return [];
    }

    /**
     * @return TypoScriptFrontendController
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public static function getTyposcriptFrontendController(): ?TypoScriptFrontendController
    {
        return array_key_exists('TSFE', $GLOBALS) ? $GLOBALS['TSFE'] : null;
    }
}
