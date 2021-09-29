<?php
declare(strict_types=1);

namespace In2code\In2faq\Updates;

/**
 * This file is part of the "in2faq" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use In2code\In2faq\Service\SlugService;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\ChattyInterface;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Migrate empty slugs
 */
class FaqSlugUpdater implements UpgradeWizardInterface
{
    private const TABLE = 'tx_in2faq_domain_model_question';

    /** @var SlugService */
    protected $slugService;

    public function __construct()
    {
        $this->slugService = GeneralUtility::makeInstance(SlugService::class);
    }

    public function executeUpdate(): bool
    {
        $this->slugService->performUpdates();
        return true;
    }

    public function updateNecessary(): bool
    {
        $elementCount = $this->slugService->countOfSlugUpdates();

        return $elementCount > 0;
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class
        ];
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return 'Updates slug field "path_segment" of EXT:in2faq records';
    }

    /**
     * Get description
     *
     * @return string Longer description of this updater
     */
    public function getDescription(): string
    {
        return 'Fills empty slug field "path_segment" of EXT:in2faq records with urlized title.';
    }

    /**
     * @return string Unique identifier of this updater
     */
    public function getIdentifier(): string
    {
        return 'in2faqSlug';
    }
}
