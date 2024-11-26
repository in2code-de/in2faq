<?php

declare(strict_types=1);
namespace In2code\In2faq\Domain\Model\Dto;

use In2code\In2faq\Domain\Model\Category;
use In2code\In2faq\Domain\Repository\QuestionRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Class Filter
 */
class Filter
{
    /**
     * @var string
     */
    protected $searchterm = '';

    /**
     * @var Category
     */
    protected $category;

    /**
     * Filter constructor.
     */
    public function __construct(protected array $settings = [])
    {
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function setSettings(array $settings): self
    {
        $this->settings = $settings;
        return $this;
    }

    public function getSearchterm(): string
    {
        return $this->searchterm;
    }

    public function setSearchterm(string $searchterm): self
    {
        $this->searchterm = $searchterm;
        return $this;
    }

    /**
     * Split searchterm on space for a real fulltext search
     */
    public function getSearchterms(): array
    {
        return explode(' ', $this->getSearchterm());
    }

    /**
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function isSet(): bool
    {
        return $this->searchterm !== '' || $this->category !== null;
    }

    /**
     * Return all faqs that are filtered by this criteria
     *
     * @throws InvalidQueryException
     */
    public function getQuestions(): ?QueryResultInterface
    {
        $questionRepository = GeneralUtility::makeInstance(QuestionRepository::class);
        return $questionRepository->findByFilterAndSettings($this);
    }
}
