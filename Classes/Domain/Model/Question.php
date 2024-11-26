<?php

declare(strict_types=1);
namespace In2code\In2faq\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Question
 */
class Question extends AbstractEntity
{
    const TABLE_NAME = 'tx_in2faq_domain_model_question';

    /**
     * @var string
     */
    protected $question = '';

    /**
     * @var string
     */
    protected $answer = '';

    /**
     * @var string
     */
    protected $questionFrom = '';

    /**
     * @var string
     */
    protected $relatedLinks = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\In2code\In2faq\Domain\Model\Category>
     */
    protected $categories;

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question): static
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer): static
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuestionFrom()
    {
        return $this->questionFrom;
    }

    /**
     * @param string $questionFrom
     */
    public function setQuestionFrom($questionFrom): static
    {
        $this->questionFrom = $questionFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getRelatedLinks()
    {
        return $this->relatedLinks;
    }

    /**
     * @param string $relatedLinks
     */
    public function setRelatedLinks($relatedLinks): static
    {
        $this->relatedLinks = $relatedLinks;
        return $this;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
     */
    public function setCategories($categories): static
    {
        $this->categories = $categories;
        return $this;
    }
}
