<?php
declare(strict_types=1);
namespace In2code\In2faq\Controller;

use In2code\In2faq\Domain\Repository\QuestionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class FaqController
 */
class FaqController extends ActionController
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @return void
     */
    public function listAction()
    {
        $faqs = $this->questionRepository->findBySettings((array)$this->settings);
        $this->view->assign('faqs', $faqs);
    }

    /**
     * @param QuestionRepository $questionRepository
     * @return void
     */
    public function injectQuestionRepository(QuestionRepository $questionRepository): void
    {
        $this->questionRepository = $questionRepository;
    }
}
