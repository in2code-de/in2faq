<?php

declare(strict_types=1);

namespace In2code\In2faq\Command;

use Exception;
use In2code\In2faq\Importer\Category;
use In2code\In2faq\Importer\Question;
use In2code\In2faq\Importer\QuestionCategory;
use In2code\In2faq\Utility\ObjectUtility;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ImportFromIrfaqCommandController
 */
class ImportFromIrfaqCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setHelp('Imports existing irfaq records');
        $this->addOption('dryRun', null, InputOption::VALUE_OPTIONAL,'Set if you want a dry-run', false);
        $this->addOption('forcePid', null, InputOption::VALUE_OPTIONAL, 'Set if you want to import to a specific pid.');
    }

    /**
     * Import everything from irfaq (old values will be deleted!)
     *
     *  This importer imports values from existing irfaq tables (like tx_irfaq_q, etc...)
     *  to new tables (like tx_in2faq_domain_model_question, etc...).
     *  Warning: New tables will be truncated before import!!
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $dryrun = $input->getOption('dryRun');
        $forcePid = $input->getOption('forcePid');

        $io = new SymfonyStyle($input, $output);

        $io->writeln($this->importCategories($dryrun, $forcePid));
        $io->writeln($this->importQuestions($dryrun, $forcePid));
        $io->writeln($this->importQuestionCategoriesRelation($dryrun, $forcePid));

        return Command::SUCCESS;
    }

    /**
     * Import categories
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return string
     * @throws Exception
     */
    protected function importCategories($dryrun, $forcePid): string
    {
        $importer = ObjectUtility::getObjectManager()->get(Category::class);
        return  $importer->import($dryrun, $forcePid);
    }

    /**
     * Import questions
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return string
     * @throws Exception
     */
    protected function importQuestions($dryrun, $forcePid): string
    {
        $importer = ObjectUtility::getObjectManager()->get(Question::class);
        return $importer->import($dryrun, $forcePid);
    }

    /**
     * Import relations between questions and categories
     *
     * @param boolean $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return string
     * @throws Exception
     */
    protected function importQuestionCategoriesRelation($dryrun, $forcePid): string
    {
        $importer = ObjectUtility::getObjectManager()->get(QuestionCategory::class);
        return $importer->import($dryrun, $forcePid);
    }
}
