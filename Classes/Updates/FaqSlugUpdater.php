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
class FaqSlugUpdater implements UpgradeWizardInterface
{
    private const TABLE = 'tx_in2faq_domain_model_question';

    /**
     * @var SlugService
     */
    protected $slugService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slugService = GeneralUtility::makeInstance(SlugService::class);
    }

    /**
     * @return bool
     */
    public function executeUpdate(): bool
    {
        $this->slugService->performUpdates();
        return true;
    }

    /**
     * @return bool
     */
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
