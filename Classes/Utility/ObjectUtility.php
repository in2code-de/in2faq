<?php
declare(strict_types=1);
namespace In2code\In2faq\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Class ObjectUtility
 */
class ObjectUtility
{
    /**
     * @return ObjectManager
     */
    public static function getObjectManager()
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
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
