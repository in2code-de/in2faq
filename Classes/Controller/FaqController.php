<?php
declare(strict_types=1);
namespace In2code\In2faq\Controller;

use In2code\In2faq\Domain\Repository\CategoryRepository;
use In2code\In2faq\Domain\Repository\QuestionRepository;
use In2code\In2faq\Utility\ObjectUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

/**
 * Class FaqController
 * @noinspection PhpUnused
 */
class FaqController extends ActionController
{
    /**
     * @return void
     * @noinspection PhpUnused
     * @throws InvalidQueryException
     */
    public function listAction(): void
    {
        $questionRepository = ObjectUtility::getObjectManager()->get(QuestionRepository::class);
        $faqs = $questionRepository->findBySettings((array)$this->settings);
        $this->view->assign('faqs', $faqs);
    }

    /**
     * @return void
     * @noinspection PhpUnused
     * @throws InvalidQueryException
     */
    public function filterAction(): void
    {
        $questionRepository = ObjectUtility::getObjectManager()->get(CategoryRepository::class);
        $categories = $questionRepository->findBySettings($this->settings);
        $this->view->assign('categories', $categories);
    }
}
