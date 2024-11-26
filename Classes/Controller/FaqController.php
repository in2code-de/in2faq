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
    public function __construct(protected \In2code\In2faq\Domain\Repository\QuestionRepository $questionRepository)
    {
    }
    protected function initializeAction(): void
    {
        if ($this->arguments->hasArgument('filter')) {
            $this->arguments->getArgument('filter')->getPropertyMappingConfiguration()
                ->allowProperties('category');
        }
    }

    /**
     * List action to list questions.
     * Note: Questions are delivered with $filter->getQuestions() in view
     *
     * @noinspection PhpUnused
     */
    public function listAction(Filter $filter = null): ResponseInterface
    {
        if (!$filter instanceof \In2code\In2faq\Domain\Model\Dto\Filter) {
            $filter = $this->initializeFilterObject();
        }

        $this->view->assignMultiple([
            'filter' => $filter,
            'data' => $this->request->getAttribute('currentContentObject')->data,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @noinspection PhpUnused
     * @throws Exception
     */
    public function filterAction(Filter $filter = null): ResponseInterface
    {
        if (!$filter instanceof \In2code\In2faq\Domain\Model\Dto\Filter) {
            $filter = $this->initializeFilterObject();
        }

        $categoryRepository = GeneralUtility::makeInstance(CategoryRepository::class);
        $data = $this->request->getAttribute('currentContentObject')->data;
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
        // get question from flexform settings
        if ($question === 0) {
            $question = (int)$this->settings['question'];
        }

        $questionObject = $this->questionRepository->findByUid($question);
        $this->view->assign('question', $questionObject);
        return $this->htmlResponse();
    }
}
