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
    protected $categories = null;

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
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
     * @return Question
     */
    public function setAnswer($answer)
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
     * @return Question
     */
    public function setQuestionFrom($questionFrom)
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
     * @return Question
     */
    public function setRelatedLinks($relatedLinks)
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
     * @return Question
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }
}
