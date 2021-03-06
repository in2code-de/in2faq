<?php
declare(strict_types=1);
namespace In2code\In2faq\Command;

use In2code\In2faq\Importer\Category;
use In2code\In2faq\Importer\Expert;
use In2code\In2faq\Importer\Question;
use In2code\In2faq\Importer\QuestionCategory;
use In2code\In2faq\Utility\ObjectUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class ImportFromIrfaqCommandController
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
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
     */
    protected function importQuestionCategoriesRelation($dryrun, $forcePid)
    {
        $importer = ObjectUtility::getObjectManager()->get(QuestionCategory::class);
        $result = $importer->import($dryrun, $forcePid);
        $this->outputLine($result);
    }
}
