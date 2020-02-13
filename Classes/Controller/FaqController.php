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
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

/**
 * Class FaqController
 * @noinspection PhpUnused
 */
class FaqController extends ActionController
{
    /**
     * @return void
     * @throws InvalidArgumentNameException
     * @noinspection PhpUnused
     */
    public function initializeListAction(): void
    {
        $this->initializeFilterObject();
    }

    /**
     * @param Filter $filter
     * @return void
     * @noinspection PhpUnused
     */
    public function listAction(Filter $filter): void
    {
        $this->view->assignMultiple([
            'filter' => $filter,
            'data' => $this->configurationManager->getContentObject()->data
        ]);
    }

    /**
     * @return void
     * @throws InvalidArgumentNameException
     * @noinspection PhpUnused
     */
    public function initializeFilterAction(): void
    {
        $this->initializeFilterObject();
    }

    /**
     * @param Filter $filter
     * @return void
     * @throws InvalidQueryException
     * @noinspection PhpUnused
     */
    public function filterAction(Filter $filter): void
    {
        $questionRepository = ObjectUtility::getObjectManager()->get(CategoryRepository::class);
        $data = $this->configurationManager->getContentObject()->data;
        $categories = $questionRepository->findBySettings($this->settings, $data);
        $this->view->assignMultiple([
            'categories' => $categories,
            'filter' => $filter,
            'data' => $data
        ]);
    }

    /**
     * @return void
     * @throws InvalidArgumentNameException
     */
    protected function initializeFilterObject(): void
    {
        $filter = ObjectUtility::getObjectManager()->get(FilterFactory::class, $this->settings)->getInstance();
        $this->request->setArgument('filter', $filter);
    }
}
