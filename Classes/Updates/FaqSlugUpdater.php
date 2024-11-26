<?php

declare(strict_types=1);

namespace In2code\In2faq\Updates;

use In2code\In2faq\Service\SlugService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Migrate empty slugs
 */
#[UpgradeWizard('in2faqSlug')]
class FaqSlugUpdater implements UpgradeWizardInterface
{
    /**
     * @var SlugService
     */
    protected object $slugService;

    /**
     * Constructor
     */
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

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    /**
     * Get title
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
