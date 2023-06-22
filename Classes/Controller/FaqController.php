<?php

declare(strict_types=1);

namespace In2code\In2faq\Controller;

use In2code\In2faq\Domain\Factory\FilterFactory;
use In2code\In2faq\Domain\Model\Dto\Filter;
use In2code\In2faq\Domain\Repository\CategoryRepository;
use In2code\In2faq\Domain\Repository\QuestionRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
     * @throws InvalidArgumentNameException
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function initializeListAction(): ResponseInterface
    {
        $filter = $this->initializeFilterObject();
        return $this->listAction($filter);
    }

    /**
     * List action to list questions.
     * Note: Questions are delivered with $filter->getQuestions() in view
     *
     * @noinspection PhpUnused
     */
    public function listAction(Filter $filter): ResponseInterface
    {
        $this->view->assignMultiple([
            'filter' => $filter,
            'data' => $this->configurationManager->getContentObject()->data,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @throws InvalidArgumentNameException
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function initializeFilterAction(): ResponseInterface
    {
        $filter = $this->initializeFilterObject();
        return $this->filterAction($filter);
    }

    /**
     * @param Filter $filter
     * @return void
     * @noinspection PhpUnused
     * @throws Exception
     */
    public function filterAction(Filter $filter): ResponseInterface
    {
        $categoryRepository = GeneralUtility::makeInstance(CategoryRepository::class);
        $data = $this->configurationManager->getContentObject()->data;
        $categories = $categoryRepository->findBySettings($this->settings, $data);
        $this->view->assignMultiple([
            'categories' => $categories,
            'filter' => $filter,
            'data' => $data,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @throws InvalidArgumentNameException
     * @throws Exception
     */
    protected function initializeFilterObject(): Filter
    {
        return GeneralUtility::makeInstance(FilterFactory::class, $this->settings)->getInstance();
    }

    protected function detailAction(int $question = 0): ResponseInterface
    {
        $questionObject = $this->questionRepository->findByUid($question);
        $this->view->assign('question', $questionObject);
        return $this->htmlResponse();
    }
}
