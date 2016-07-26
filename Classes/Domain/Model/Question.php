<?php
namespace In2code\In2faq\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Question
 * @package In2code\In2faq\Domain\Model
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
