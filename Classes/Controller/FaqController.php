<?php

declare(strict_types=1);

namespace In2code\In2faq\Controller;

use In2code\In2faq\Domain\Factory\FilterFactory;
use In2code\In2faq\Domain\Model\Dto\Filter;
use In2code\In2faq\Domain\Repository\CategoryRepository;
use In2code\In2faq\Domain\Repository\QuestionRepository;
use In2code\In2faq\Utility\ObjectUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException;
use TYPO3\CMS\Extbase\Object\Exception;

/**
 * Class FaqController
 * @noinspection PhpUnused
 */
class FaqController extends ActionController
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @param QuestionRepository $questionRepository
     * @return void
     */
    public function injectQuestionRepository(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @return void
     * @throws InvalidArgumentNameException
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function initializeListAction(): void
    {
        $this->initializeFilterObject();
    }

    /**
     * List action to list questions.
     * Note: Questions are delivered with $filter->getQuestions() in view
     *
     * @param Filter $filter
     * @return void
     * @noinspection PhpUnused
     */
    public function listAction(Filter $filter)
    {
        $this->view->assignMultiple([
            'filter' => $filter,
            'data' => $this->configurationManager->getContentObjectRenderer()()->data,
        ]);
    }

    /**
     * @return void
     * @throws InvalidArgumentNameException
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function initializeFilterAction(): void
    {
        $this->initializeFilterObject();
    }

    /**
     * @param Filter $filter
     * @return void
     * @noinspection PhpUnused
     * @throws Exception
     */
    public function filterAction(Filter $filter)
    {
        $categoryRepository = ObjectUtility::getObjectManager()->get(CategoryRepository::class);
        $data = $this->configurationManager->getContentObjectRenderer()()->data;
        $categories = $categoryRepository->findBySettings($this->settings, $data);
        $this->view->assignMultiple([
            'categories' => $categories,
            'filter' => $filter,
            'data' => $data,
        ]);
    }

    /**
     * @return void
     * @throws InvalidArgumentNameException
     * @throws Exception
     */
    protected function initializeFilterObject(): void
    {
        $filter = ObjectUtility::getObjectManager()->get(FilterFactory::class, $this->settings)->getInstance();
        $this->request->setArgument('filter', $filter);
    }

    /**
     * @param int $question
     * @return void
     */
    protected function detailAction(int $question = 0): void
    {
        $questionObject = $this->questionRepository->findByUid($question);
        $this->view->assign('question', $questionObject);
    }
}
