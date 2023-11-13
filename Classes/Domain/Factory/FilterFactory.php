<?php

declare(strict_types=1);
namespace In2code\In2faq\Domain\Factory;

use In2code\In2faq\Domain\Model\Category;
use In2code\In2faq\Domain\Model\Dto\Filter;
use In2code\In2faq\Domain\Repository\CategoryRepository;
use In2code\In2faq\Utility\FrontendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Class FilterFactory
 * to change filter array to a filter object (for Pi1 and Pi2)
 */
class FilterFactory
{
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * FilterFactory constructor.
     */
    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
    }

    /**
     * @return Filter
     */
    public function getInstance(): Filter
    {
        $arguments = FrontendUtility::getArguments();
        $filter = GeneralUtility::makeInstance(Filter::class, $this->settings);
        if (!empty($arguments['filter'])) {
            $this->setSearchterm($filter, $arguments);
            $this->setCategory($filter, $arguments);
        }
        return $filter;
    }

    /**
     * @param Filter $filter
     * @param array $arguments
     * @return void
     */
    protected function setCategory(Filter $filter, array $arguments): void
    {
        if (!empty($arguments['filter']['category'])
            && MathUtility::canBeInterpretedAsInteger($arguments['filter']['category'])) {
            $categoryRepository = GeneralUtility::makeInstance(CategoryRepository::class);
            /** @var Category $category */
            $category = $categoryRepository->findByIdentifier((int)$arguments['filter']['category']);
            $filter->setCategory($category);
        }
    }

    /**
     * @param Filter $filter
     * @param array $arguments
     * @return void
     */
    protected function setSearchterm(Filter $filter, array $arguments): void
    {
        if (!empty($arguments['filter']['searchterm'])) {
            $filter->setSearchterm($arguments['filter']['searchterm']);
        }
    }
}
