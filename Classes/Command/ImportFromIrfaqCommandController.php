<?php
namespace In2code\In2faq\Command;

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

use In2code\In2faq\Importer\Category;
use In2code\In2faq\Importer\Expert;
use In2code\In2faq\Importer\Question;
use In2code\In2faq\Importer\QuestionCategory;
use In2code\In2faq\Utility\ObjectUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class ImportFromIrfaqCommandController
 * @package In2code\In2faq\Command
 */
class ImportFromIrfaqCommandController extends CommandController
{

    /**
     * Import everything from irfaq (old values will be deleted!)
     *
     *  This importer imports values from existing irfaq tables (like tx_irfaq_q, etc...)
     *  to new tables (like tx_in2faq_domain_model_question, etc...).
     *  Warning: New tables will be truncated before import!!
     *
     * @param boolean $dryrun Test how many record could be imported
     * @param int $forcePid Force import of all records to a pid
     * @return void
     */
    public function importCommand($dryrun = false, $forcePid = null)
    {
        $this->importCategories($dryrun, $forcePid);
        $this->importExperts($dryrun, $forcePid);
        $this->importQuestions($dryrun, $forcePid);
        $this->importQuestionCategoriesRelation($dryrun, $forcePid);
    }

    /**
     * Import categories
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return void
     */
    protected function importCategories($dryrun, $forcePid)
    {
        $importer = ObjectUtility::getObjectManager()->get(Category::class);
        $result = $importer->import($dryrun, $forcePid);
        $this->outputLine($result);
    }

    /**
     * Import experts
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return void
     */
    protected function importExperts($dryrun, $forcePid)
    {
        $importer = ObjectUtility::getObjectManager()->get(Expert::class);
        $result = $importer->import($dryrun, $forcePid);
        $this->outputLine($result);
    }

    /**
     * Import questions
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return void
     */
    protected function importQuestions($dryrun, $forcePid)
    {
        $importer = ObjectUtility::getObjectManager()->get(Question::class);
        $result = $importer->import($dryrun, $forcePid);
        $this->outputLine($result);
    }

    /**
     * Import relations between questions and categories
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return void
     */
    protected function importQuestionCategoriesRelation($dryrun, $forcePid)
    {
        $importer = ObjectUtility::getObjectManager()->get(QuestionCategory::class);
        $result = $importer->import($dryrun, $forcePid);
        $this->outputLine($result);
    }
}
